<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Generator;

use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;

interface TypeGeneratorInterface
{
    public function createGetTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method;

    public function createTransformTypeMethodOnSchema(SchemaConfig $config, ClassType $class): Method;

    public function transformTypeMethodName(SchemaConfig $config): string;

    public function getTypeMethodName(SchemaConfig $config): string;

    /** @return array<string, string> */
    public function subscribeService(SchemaConfig $config): array;

    public function generateGeneratedClass(FilesystemOperator $fs, SchemaConfig $config): void;

    public function generateUserClass(FilesystemOperator $fs, SchemaConfig $config): void;
}
