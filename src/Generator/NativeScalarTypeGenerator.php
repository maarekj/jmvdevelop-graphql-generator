<?php

namespace JmvDevelop\GraphqlGenerator\Generator;

use JmvDevelop\GraphqlGenerator\Schema\ScalarType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;

final class NativeScalarTypeGenerator extends ScalarTypeGenerator
{
    public function __construct(ScalarType $type, private string $nativeType)
    {
        parent::__construct($type);
    }

    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method
    {
        $dumper = new Dumper();

        $method = $class->addMethod($this->getTypeMethodName($config));
        $method->setReturnType('\GraphQL\Type\Definition\ScalarType');
        $method->addBody(
            \strtr(
                '
                return \GraphQL\Type\Definition\Type:::nativeType();
            ',
                [
                    ':name' => $dumper->dump($this->type->getName()),
                    ':description' => $dumper->dump($this->type->getDescription()),
                    ':nativeType' => $this->nativeType,
                ]
            )
        );

        return $method;
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
