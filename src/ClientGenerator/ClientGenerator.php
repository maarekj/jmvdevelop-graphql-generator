<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Error\SyntaxError;
use GraphQL\Language\AST\ListTypeNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\NonNullTypeNode;
use GraphQL\Language\AST\OperationDefinitionNode;
use GraphQL\Language\Parser;
use GraphQL\Language\Printer;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\PhpFile;
use Webmozart\Assert\Assert;

final class ClientGenerator
{
    public function __construct(private Config $config)
    {
    }

    /**
     * @throws SyntaxError
     * @throws FilesystemException
     */
    public function generateClient(FilesystemOperator $fs): void
    {
        $fs->deleteDirectory('/ClientGenerated');

        $baseNs = $this->config->getNamespace();

        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace($baseNs.'\ClientGenerated');
        $class = $namespace
            ->addClass('AbstractClient')
            ->setAbstract()
        ;

        $class->addMethod('__construct')
            ->addPromotedParameter('mapper')->setType($baseNs.'\Mapper')->setVisibility('protected');

        $executeMethod = $class->addMethod('execute')->setReturnType('array')->setAbstract();
        $executeMethod->addParameter('query')->setType('string');
        $executeMethod->addParameter('variables')->setType('array')->setDefaultValue([]);

        foreach ($this->config->getQueryFinder()->findQueries() as $query) {
            $document = Parser::parse($query);
            $definitions = $document->definitions;
            foreach ($definitions as $definition) {
                if ($definition instanceof OperationDefinitionNode) {
                    $this->handleOperation(class: $class, operation: $definition);
                }
            }
        }

        $userFile = new PhpFile();
        $userFile->setStrictTypes(true);

        $userNamespace = $userFile->addNamespace($baseNs);
        $userClass = $userNamespace->addClass('Client');
        $userClass->setFinal()->addExtend('\\'.$baseNs.'\\ClientGenerated\\AbstractClient');

        writeFile(fs: $fs, baseNs: $baseNs, file: $file, overwrite: true);
        writeFile(fs: $fs, baseNs: $baseNs, file: $userFile, overwrite: false);

        $mapperGenerator = new MapperGenerator(config: $this->config);
        $mapperGenerator->generateMapper(fs: $fs);

        foreach ($this->config->getSchema()->getTypeMap() as $type) {
            if ($type instanceof InputObjectType) {
                $generator = new InputObjectTypeGenerator(config: $this->config, type: $type);
                $generator->generateClass(fs: $fs);
            }
        }
    }

    private function handleOperation(ClassType $class, OperationDefinitionNode $operation): void
    {
        $dumper = new Dumper();
        $graphqlToPhpCompiler = new GraphqlToPhpCompiler(schema: $this->config->getSchema());
        $graphqlTypeToPhpCompiler = new GraphqlTypeToPhpTypeCompiler(config: $this->config);

        $operationName = $operation->name?->value;
        Assert::notNull($operationName, 'An operation must have a name');

        $gqlMethod = $class->addMethod('gql_'.$operationName);
        $gqlMethod->setReturnType('string');
        $gqlMethod->setBody('return '.$dumper->dump(Printer::doPrint($operation)).';');

        $parseMethod = $class->addMethod('parse_'.$operationName);
        $parseMethod->addParameter('data')->setType('array');

        $queryType = $this->config->getSchema()->getType('Query');
        Assert::notNull($queryType);
        Assert::isInstanceOf($queryType, ObjectType::class);

        $parseMethod->addBody('return ('.$graphqlToPhpCompiler->compileSelectionSet(
                variable: '$data',
                set: $operation->selectionSet,
                baseType: $queryType
            ).');');

        $parseMethod->addComment('@return '.$graphqlTypeToPhpCompiler->compileSelectionSetToPsalmType(
                set: $operation->selectionSet,
                baseType: $queryType,
            )
        );

        $variables = [];

        $executeMethod = $class->addMethod('execute_'.$operationName);

        $executeMethod->addComment('@return '.$graphqlTypeToPhpCompiler->compileSelectionSetToPsalmType(
                set: $operation->selectionSet,
                baseType: $queryType,
            )
        );

        foreach ($operation->variableDefinitions as $variableDefinition) {
            $forceCanBeNull = null !== $variableDefinition->defaultValue;

            $executeMethod
                ->addParameter($variableDefinition->variable->name->value)
                ->setType($graphqlTypeToPhpCompiler->compileTypeNodeToPhpType(typeNode: $variableDefinition->type, forceCanBeNull: $forceCanBeNull))
            ;

            $php = $graphqlTypeToPhpCompiler->compileTypeNodeToPhpType(typeNode: $variableDefinition->type, forceCanBeNull: $forceCanBeNull);
            $psalm = $graphqlTypeToPhpCompiler->compileTypeNodeToPsalmType(typeNode: $variableDefinition->type, forceCanBeNull: $forceCanBeNull);

            if ($php !== $psalm) {
                $executeMethod->addComment('@param '.$psalm.' $'.$variableDefinition->variable->name->value);
            }

            $variables[] = '"'.$variableDefinition->variable->name->value.'" => '.$this->compilePhpValueToGraphql(variable: '$'.$variableDefinition->variable->name->value, typeNode: $variableDefinition->type);
        }

        $executeMethod->addBody(\strtr('
$___result = $this->execute($this->gql_:name(), :variables);
return $this->parse_:name($___result);
', [
            ':name' => $operationName,
            ':variables' => '['.\implode(",\n", $variables).']',
        ]));
    }

    private function compilePhpValueToGraphql(string $variable, NamedTypeNode | ListTypeNode | NonNullTypeNode $typeNode, bool $canBeNull = true): string
    {
        $nullOr = $canBeNull ? "({$variable}) === null ? null : " : '';

        if ($typeNode instanceof NamedTypeNode) {
            $typeName = $typeNode->name->value;

            return $nullOr.'$this->mapper->php_to_graphql_'.$typeName.'('.$variable.')';
        } elseif ($typeNode instanceof NonNullTypeNode) {
            return $this->compilePhpValueToGraphql(variable: $variable, typeNode: $typeNode->type, canBeNull: false);
        } elseif ($typeNode instanceof ListTypeNode) {
            return \strtr(':nullOr array_map(fn($_value) =>
                            return (:sub);
            }, (:variable))', [
                ':nullOr' => $nullOr,
                ':variable' => $variable,
                ':sub' => $this->compilePhpValueToGraphql(variable: '$_value', typeNode: $typeNode->type),
            ]);
        }

        throw new \RuntimeException('impossible');
    }
}
