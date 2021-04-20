<?php

namespace JmvDevelop\GraphqlGenerator\Generator;

use JmvDevelop\GraphqlGenerator\Schema\EnumType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;

final class EnumTypeGenerator implements TypeGeneratorInterface
{
    public function __construct(protected EnumType $type)
    {
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $propertyName = 'property_enum_type_'.$this->type->getName();
        $class->addProperty($propertyName)->setValue(null)->setPrivate();

        $method = $class->addMethod($this->getTypeMethodName($config));
        $method->setReturnType('\GraphQL\Type\Definition\EnumType');
        $method->addBody(\strtr(
            '
                if ($this->:property === null) {
                    $this->:property = new \GraphQL\Type\Definition\EnumType([
                        "description" => :description,
                        "name" => :name,
                        "values" => [
                        ',
            [
                ':property' => $propertyName,
                ':name' => $dumper->dump($this->type->getName()),
                ':description' => $dumper->dump($this->type->getDescription()),
            ]
        ));

        foreach ($this->type->getValues() as $value) {
            $method->addBody(\strtr(':name => [
                "name" => :name,
                "description" => :description,
                "value" => :value,
            ],', [
                ':name' => $dumper->dump($value->getName()),
                ':description' => $dumper->dump($value->getDescription()),
                ':value' => $dumper->dump($value->getValue()),
            ]));
        }

        $method->addBody(\strtr(
            '           ]
                    ]);
                }
                return $this->:property;
            ',
            [
                ':property' => $propertyName,
            ]
        ));

        return $method;
    }

    public function createTransformTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $method = $class->addMethod($this->transformTypeMethodName($config))->setPrivate();
        $method->addParameter('value');
        $method->addBody('return $value;');

        return $method;
    }

    public function transformTypeMethodName(SchemaConfig $config): string
    {
        return 'transform_enum_type_'.$this->type->getName();
    }

    public function getTypeMethodName(SchemaConfig $config): string
    {
        return 'get_enum_type_'.$this->type->getName();
    }

    public function subscribeService(SchemaConfig $config): array
    {
        return [];
    }

    public function generateGeneratedClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
    }

    public function generateUserClass(FilesystemOperator $fs, SchemaConfig $config): void
    {
    }
}
