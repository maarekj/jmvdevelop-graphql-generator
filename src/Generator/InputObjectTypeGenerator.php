<?php

namespace JmvDevelop\GraphqlGenerator\Generator;

use GraphQL\Language\Parser;
use JmvDevelop\GraphqlGenerator\Schema\InputObjectType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use function JmvDevelop\GraphqlGenerator\Utils\callArgsFrom__args;
use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\fqcn;
use function JmvDevelop\GraphqlGenerator\Utils\getPhpTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getPsalmTypeOf;
use function JmvDevelop\GraphqlGenerator\Utils\getTypeFromRegistry;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;

class InputObjectTypeGenerator implements TypeGeneratorInterface
{
    public function __construct(private InputObjectType $type)
    {
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $propertyName = 'property_input_object_type_'.$this->type->getName();
        $class->addProperty($propertyName)->setValue(null)->setPrivate();

        $method = $class->addMethod($this->getTypeMethodName($config));

        $method->setReturnType('\GraphQL\Type\Definition\InputObjectType');
        $method->addBody(\strtr('
            if ($this->:property === null) {
                $this->:property = new \GraphQL\Type\Definition\InputObjectType([
                    "description" => :description, 
                    "name" => :name,
                    "fields" => function () {
                        return [
            ', [
            ':name' => $dumper->dump($this->type->getName()),
            ':description' => $dumper->dump($this->type->getDescription()),
            ':property' => $propertyName,
        ]));

        foreach ($this->type->getFields() as $field) {
            $method->addBody(\strtr(':fieldName => [
                        "type" => :type,
                        "description" => :description,
                    ],', [
                ':fieldName' => $dumper->dump($field->getName()),
                ':type' => getTypeFromRegistry($config, Parser::parseType($field->getType())),
                ':description' => $dumper->dump($field->getDescription()),
            ]));
        }

        $method->addBody(\strtr('
                        ];
                    },
                ]);
            }
            
            return $this->:property;', [
            ':property' => $propertyName,
        ]));

        return $method;
    }

    public function createTransformTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $method = $class->addMethod($this->transformTypeMethodName($config))->setPrivate();
        $method->addParameter('value');
        $method->addBody(\sprintf(
            'return new %s(%s);',
            '\\'.$this->fqcnClass($config),
            callArgsFrom__args(config: $config, args: $this->type->getFields(), arrayName: '$value'),
        ));

        return $method;
    }

    public function transformTypeMethodName(SchemaConfig $config): string
    {
        return 'transform_input_object_type_'.$this->type->getName();
    }

    public function getTypeMethodName(SchemaConfig $config): string
    {
        return 'get_input_object_type_'.$this->type->getName();
    }

    public function subscribeService(SchemaConfig $config): array
    {
        return [];
    }

    public function generateGeneratedClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace(extractBaseNamespace($this->fqcnClass($config)));
        $class = $namespace->addClass(extractShortName($this->fqcnClass($config)))->setFinal(true);

        $constructor = $class->addMethod('__construct');

        foreach ($this->type->getFields() as $field) {
            $psalmArgType = getPsalmTypeOf(config: $config, type: Parser::parseType($field->getType()));
            $phpArgType = getPhpTypeOf(config: $config, type: Parser::parseType($field->getType()));

            if ($psalmArgType !== $phpArgType) {
                $constructor->addComment('@param '.$psalmArgType.' $'.$field->getName());
            }

            $constructor
                ->addPromotedParameter($field->getName())->setType($phpArgType)
                ->setPublic()
            ;
        }

        writeFile(fs: $fs, config: $config, file: $file, overwrite: true);
    }

    public function generateUserClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
    }

    public function fqcnClass(SchemaConfig $config): string
    {
        return fqcn(config: $config, parts: [
            'Generated',
            $this->type->getSuffixNamespace(),
            \ucfirst($this->type->getName()).'Type',
        ]);
    }
}
