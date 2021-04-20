<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Utils;

use Nette\InvalidStateException;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

final class AddUseInFile
{
    public static function visitFile(PhpFile $file): void
    {
        foreach ($file->getNamespaces() as $namespace) {
            self::visitNamespace($namespace);
        }
    }

    private static function visitNamespace(PhpNamespace $namespace): void
    {
        foreach ($namespace->getClasses() as $class) {
            self::visitClass($namespace, $class);
        }
    }

    private static function visitClass(PhpNamespace $namespace, ClassType $class): void
    {
        foreach ((array) $class->getExtends() as $extend) {
            self::addUseIfCan($namespace, $extend);
        }

        foreach ($class->getImplements() as $implement) {
            self::addUseIfCan($namespace, $implement);
        }

        foreach ($class->getMethods() as $method) {
            self::visitMethod($namespace, $method);
        }
    }

    private static function visitMethod(PhpNamespace $namespace, Method $method): void
    {
        self::addUseFromType($namespace, $method->getReturnType());
        foreach ($method->getParameters() as $parameter) {
            self::visitParameter($namespace, $parameter);
        }
    }

    private static function visitParameter(PhpNamespace $namespace, Parameter $parameter): void
    {
        self::addUseFromType($namespace, $parameter->getType());
    }

    private static function addUseFromType(PhpNamespace $namespace, null | string $type): void
    {
        $type = null === $type ? '' : \trim($type);
        $types = \array_map(fn ($t) => \trim($t), \explode('|', $type));
        $types = \array_filter($types, fn ($t) => match ($t) {
            'string', 'float', 'int', 'bool', 'mixed', 'array', 'iterable', 'object', 'scalar', 'null',
            '\\string', '\\float', '\\int', '\\bool', '\\mixed', '\\array', '\\iterable', '\\object', '\\scalar', '\\null' => false,
            default => true,
        });

        foreach ($types as $type) {
            self::addUseIfCan($namespace, $type);
        }
    }

    private static function addUseIfCan(PhpNamespace $namespace, ?string $type): void
    {
        if (null !== $type && '' !== \trim($type)) {
            try {
                $classes = \array_values(\array_map(fn (ClassType $class) => $class->getName(), $namespace->getClasses()));
                $shortName = extractShortName($type);
                if (true === \in_array($shortName, $classes, true)) {
                    return;
                }

                $namespace->addUse($type);
            } catch (InvalidStateException) {
            }
        }
    }
}
