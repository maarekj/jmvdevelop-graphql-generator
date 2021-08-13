<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Type\Definition\InputObjectField;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\NonNull;
use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\phpTypeIsNullable;
use function JmvDevelop\GraphqlGenerator\Utils\writeFile;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;

final class InputObjectTypeGenerator
{
    private GraphqlTypeToPhpTypeCompiler $graphqlTypeToPhpTypeCompiler;

    public function __construct(private Config $config, private InputObjectType $type)
    {
        $this->graphqlTypeToPhpTypeCompiler = new GraphqlTypeToPhpTypeCompiler(config: $this->config);
    }

    public function generateClass(FilesystemOperator $fs): void
    {
        $baseNs = $this->config->getNamespace();

        $file = new PhpFile();
        $file->setStrictTypes(true);

        $namespace = $file->addNamespace(extractBaseNamespace($this->fqcnClass()));
        $class = $namespace->addClass(extractShortName($this->fqcnClass()))->setFinal(true);

        $constructor = $class->addMethod('__construct');

        $fields = $this->type->getFields();
        \usort($fields, function (InputObjectField $a, InputObjectField $b): int {
            return $b->getType() instanceof NonNull <=> $a->getType() instanceof NonNull;
        });

        foreach ($fields as $field) {
            $this->addFieldToConstructor(constructor: $constructor, field: $field);
        }

        foreach ($fields as $field) {
            $this->addWithMethodForField(field: $field, class: $class);
        }

        writeFile(fs: $fs, baseNs: $baseNs, file: $file, overwrite: true);
    }

    public function fqcnClass(): string
    {
        return $this->config->getNamespace().'\\ClientGenerated\\InputObject\\'.\ucfirst($this->type->name);
    }

    private function addFieldToConstructor(Method $constructor, InputObjectField $field): void
    {
        $psalmArgType = $this->graphqlTypeToPhpTypeCompiler->compileTypeToPsalmType(type: $field->getType());
        $phpArgType = $this->graphqlTypeToPhpTypeCompiler->compileTypeToPhpType(type: $field->getType(), forceCanBeNull: false);

        if ($psalmArgType !== $phpArgType) {
            $constructor->addComment('@param '.$psalmArgType.' $'.$field->name);
        }

        $parameter = $constructor
            ->addPromotedParameter($field->name)->setType($phpArgType)
            ->setPublic()
        ;

        if (true === phpTypeIsNullable($phpArgType)) {
            $parameter->setDefaultValue(null);
        }
    }

    private function addWithMethodForField(InputObjectField $field, ClassType $class): void
    {
        $psalmArgType = $this->graphqlTypeToPhpTypeCompiler->compileTypeToPsalmType(type: $field->getType());
        $phpArgType = $this->graphqlTypeToPhpTypeCompiler->compileTypeToPhpType(type: $field->getType(), forceCanBeNull: false);

        $method = $class->addMethod('_with'.\ucfirst($field->name));
        $method->addParameter($field->name)->setType($phpArgType);
        $method->setReturnType('self');

        if ($psalmArgType !== $phpArgType) {
            $method->setComment('@param '.$psalmArgType.' $'.$field->name);
        }

        $chain = [];
        foreach ($this->type->getFields() as $f) {
            if ($f === $field) {
                $chain[] = $f->name.': $'.$f->name;
            } else {
                $chain[] = $f->name.': $this->'.$f->name;
            }
        }

        $method->addBody(\strtr('return new :className(:chain);', [
            ':className' => '\\'.$this->fqcnClass(),
            ':chain' => \implode(', ', $chain),
        ]));
    }
}
