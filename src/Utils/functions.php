<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Utils;

use GraphQL\Language\AST\ListTypeNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\NonNullTypeNode;
use GraphQL\Language\Parser;
use JmvDevelop\GraphqlGenerator\Schema\Argument;
use JmvDevelop\GraphqlGenerator\Schema\EnumType;
use JmvDevelop\GraphqlGenerator\Schema\EnumValue;
use JmvDevelop\GraphqlGenerator\Schema\InputObjectType;
use JmvDevelop\GraphqlGenerator\Schema\InterfaceType;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use JmvDevelop\GraphqlGenerator\Schema\ScalarType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use JmvDevelop\GraphqlGenerator\Schema\SchemaDefinition;
use JmvDevelop\GraphqlGenerator\Schema\UnionType;
use JmvDevelop\GraphqlGenerator\Schema\WithName;
use JmvDevelop\GraphqlGenerator\Schema\WithType;
use League\Flysystem\FilesystemOperator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

function strDef(?string $value, string $def = ''): string
{
    return null === $value ? $def : $value;
}

function getTypeFromRegistry(SchemaConfig $config, ListTypeNode|NamedTypeNode|NonNullTypeNode $type): string
{
    if ($type instanceof NamedTypeNode) {
        $typeDefinition = getTypeDefinitionOfTypeName(schema: $config->getSchema(), name: $type->name->value);
        if (null === $typeDefinition) {
            throw new \RuntimeException('Type not found: '.$type->name->value);
        }

        $getMethod = $typeDefinition->getGenerator()->getTypeMethodName(config: $config);

        return '$this->'.$getMethod.'()';
    }
    if ($type instanceof ListTypeNode) {
        return '\GraphQL\Type\Definition\Type::listOf('.getTypeFromRegistry($config, $type->type).')';
    }
    if ($type instanceof NonNullTypeNode) {
        return '\GraphQL\Type\Definition\Type::nonNull('.getTypeFromRegistry($config, $type->type).')';
    }

    throw new \RuntimeException('impossible');
}

function typeIsInput(SchemaDefinition $schema, string $name): bool
{
    foreach ($schema->getTypes() as $typeDef) {
        if ($name === $typeDef->getName() && $typeDef instanceof InputObjectType) {
            return true;
        }
    }

    return false;
}

function getTypeDefinitionOfTypeName(SchemaDefinition $schema, string $name): null|ScalarType|InputObjectType|ObjectType|EnumType|InterfaceType|UnionType
{
    foreach ($schema->getTypes() as $typeDef) {
        if ($name === $typeDef->getName()) {
            return $typeDef;
        }
    }

    return null;
}

/** @return ObjectType[] */
function getTypesWhoseImplementInterface(SchemaConfig $config, string $interface): array
{
    $results = [];
    foreach ($config->getSchema()->getTypes() as $type) {
        if ($type instanceof ObjectType) {
            if (true === \in_array($interface, $type->getInterfaces(), true)) {
                $results[] = $type;
            }
        }
    }

    return $results;
}

function phpTypeIsNullable(string $type): bool
{
    return 1 === preg_match('/^(.+[|])?null([|].+)?$/', $type);
}

function getPhpTypeOf(SchemaConfig $config, ListTypeNode|NamedTypeNode|NonNullTypeNode $type, bool $canBeNull = true): string
{
    $orNull = ($canBeNull ? '|null' : '');

    if ($type instanceof NamedTypeNode) {
        return graphqlToPhpType($config, $type->name->value).$orNull;
    }
    if ($type instanceof ListTypeNode) {
        return 'array'.$orNull;
    }
    if ($type instanceof NonNullTypeNode) {
        return getPhpTypeOf($config, $type->type, false);
    }

    throw new \RuntimeException('impossible');
}

function getPsalmTypeOf(SchemaConfig $config, ListTypeNode|NamedTypeNode|NonNullTypeNode $type, bool $canBeNull = true): string
{
    $orNull = ($canBeNull ? '|null' : '');
    if ($type instanceof NamedTypeNode) {
        return graphqlToPsalmType($config, $type->name->value).$orNull;
    }
    if ($type instanceof ListTypeNode) {
        return 'list<'.getPsalmTypeOf($config, $type->type, true).'>'.$orNull;
    }
    if ($type instanceof NonNullTypeNode) {
        return getPsalmTypeOf($config, $type->type, false);
    }

    throw new \RuntimeException('impossible');
}

function graphqlToPhpType(SchemaConfig $config, string $name): string
{
    $type = getTypeDefinitionOfTypeName($config->getSchema(), $name);
    if (null === $type) {
        throw new \RuntimeException('Type not exist');
    } elseif ($type instanceof ScalarType) {
        return $type->getRootType();
    } elseif ($type instanceof InputObjectType) {
        return '\\'.$type->getGenerator()->fqcnClass($config);
    } elseif ($type instanceof ObjectType) {
        return $type->getRootType();
    } elseif ($type instanceof EnumType) {
        $hasStringValue = \count(array_filter($type->getValues(), fn (EnumValue $value): bool => \is_string($value->getValue()))) > 0;
        $hasIntValue = \count(array_filter($type->getValues(), fn (EnumValue $value): bool => \is_int($value->getValue()))) > 0;
        $hasBoolValue = \count(array_filter($type->getValues(), fn (EnumValue $value): bool => \is_bool($value->getValue()))) > 0;
        $hasFloatValue = \count(array_filter($type->getValues(), fn (EnumValue $value): bool => \is_float($value->getValue()))) > 0;
        $hasNullValue = \count(array_filter($type->getValues(), fn (EnumValue $value): bool => null === $value->getValue())) > 0;

        $types = array_filter([
            $hasStringValue ? 'string' : null,
            $hasIntValue ? 'int' : null,
            $hasBoolValue ? 'bool' : null,
            $hasFloatValue ? 'float' : null,
            $hasNullValue ? 'null' : null,
        ]);

        if (0 === \count($types)) {
            return 'mixed';
        }

        return implode('|', $types);
    } elseif ($type instanceof InterfaceType) {
        $types = array_unique(array_map(function (ObjectType $objectType) use ($config): string {
            return graphqlToPhpType(config: $config, name: $objectType->getName());
        }, getTypesWhoseImplementInterface(config: $config, interface: $type->getName())), \SORT_REGULAR);

        return implode('|', $types);
    } elseif ($type instanceof UnionType) {
        $types = array_unique(array_map(function (string $name) use ($config): string {
            return graphqlToPhpType(config: $config, name: $name);
        }, $type->getTypes()), \SORT_REGULAR);

        return implode('|', $types);
    }

    throw new \RuntimeException('impossible');
}

function graphqlToPsalmType(SchemaConfig $config, string $name): string
{
    $type = getTypeDefinitionOfTypeName($config->getSchema(), $name);

    if (null === $type) {
        throw new \RuntimeException(sprintf('Type "%s" not exist', $name));
    } elseif ($type instanceof ScalarType) {
        return $type->getRootType();
    } elseif ($type instanceof InputObjectType) {
        return '\\'.$type->getGenerator()->fqcnClass($config);
    } elseif ($type instanceof ObjectType) {
        return $type->getPsalmType();
    } elseif ($type instanceof EnumType) {
        $types = array_unique(array_map(function (EnumValue $value): string {
            $v = $value->getValue();
            if (null === $v) {
                return 'null';
            } elseif (\is_string($v)) {
                return "'".stripslashes($v)."'";
            } elseif (true === $v) {
                return 'true';
            } elseif (false === $v) {
                return 'false';
            } elseif (\is_int($v)) {
                return sprintf('%s', $v);
            } elseif (\is_float($v)) {
                return 'float';
            }

            return 'mixed';
        }, $type->getValues()), \SORT_REGULAR);

        if (0 === \count($types)) {
            return 'mixed';
        }

        return implode('|', $types);
    } elseif ($type instanceof InterfaceType) {
        $types = array_unique(array_map(function (ObjectType $objectType) use ($config): string {
            return graphqlToPsalmType(config: $config, name: $objectType->getName());
        }, getTypesWhoseImplementInterface(config: $config, interface: $type->getName())), \SORT_REGULAR);

        return implode('|', $types);
    } elseif ($type instanceof UnionType) {
        $types = array_unique(array_map(function (string $name) use ($config): string {
            return graphqlToPsalmType(config: $config, name: $name);
        }, $type->getTypes()), \SORT_REGULAR);

        return implode('|', $types);
    }

    throw new \RuntimeException('impossible');
}

function addArgumentInParameterOfMethod(SchemaConfig $config, Method $method, Argument $arg, bool $promoted = false): void
{
    $psalmArgType = getPsalmTypeOf($config, Parser::parseType($arg->getType()));
    $phpArgType = getPhpTypeOf($config, Parser::parseType($arg->getType()));

    if ($psalmArgType !== $phpArgType) {
        $method->addComment('@psalm-param '.$psalmArgType.' $'.$arg->getName());
    }

    if ($promoted) {
        $method->addPromotedParameter($arg->getName())->setType($phpArgType);
    } else {
        $method->addParameter($arg->getName())->setType($phpArgType);
    }
}

/** @param list<WithName&WithType> $args */
function callArgsFrom__args(SchemaConfig $config, array $args, string $arrayName): string
{
    $dumper = new Dumper();
    $results = [];

    foreach ($args as $argument) {
        $name = $argument->getName();
        $nameKey = $dumper->dump($name);

        $results[] = strtr(':name: (:transformType)', [
            ':name' => $name,
            ':nameKey' => $nameKey,
            ':transformType' => transformType(
                config: $config,
                type: Parser::parseType($argument->getType()),
                value: sprintf('(%s)[%s] ?? null', $arrayName, $nameKey),
            ),
        ]);
    }

    return implode(', ', $results);
}

function callTransformType(SchemaConfig $config, ScalarType|InputObjectType|ObjectType|EnumType|InterfaceType|UnionType $type, string $value): string
{
    $transformMethod = $type->getGenerator()->transformTypeMethodName(config: $config);

    return sprintf('(null === (%s) ? null : $this->%s(%s))', $value, $transformMethod, $value);
}

function transformType(SchemaConfig $config, ListTypeNode|NamedTypeNode|NonNullTypeNode|UnionType $type, string $value): string
{
    if ($type instanceof NamedTypeNode) {
        $typeDef = getTypeDefinitionOfTypeName(schema: $config->getSchema(), name: $type->name->value);
        if (null === $typeDef) {
            return $value;
        }

        return callTransformType(config: $config, type: $typeDef, value: $value);
    } elseif ($type instanceof ListTypeNode) {
        return strtr('(function ($__value) {
                return $__value === null ? null : array_map(function ($__value) {
                    return (:rec);
                }, $__value);
            })(:value)', [
            ':rec' => transformType(config: $config, type: $type->type, value: '$__value'),
            ':value' => $value,
        ]);
    } elseif ($type instanceof NonNullTypeNode) {
        return strtr('(function ($__value) {
                return $__value === null ? null : (:rec);
            })(:value)', [
            ':rec' => transformType(config: $config, type: $type->type, value: '$__value'),
            ':value' => $value,
        ]);
    }

    throw new \RuntimeException('impossible');
}

/** @param list<string> $parts */
function fqcn(SchemaConfig $config, array $parts = []): string
{
    $trim = fn (string $part): string => trim(trim(trim($part), '//'));
    $parts = array_map($trim, array_merge([], [$config->getNamespace()], $parts));

    $parts = array_filter($parts);

    return implode('\\', $parts);
}

function extractShortName(string $name): string
{
    return ($pos = strrpos($name, '\\')) === false
        ? $name
        : substr($name, $pos + 1);
}

function extractBaseNamespace(string $fqcn): string
{
    $parts = explode('\\', trim(trim(trim($fqcn), '\\')));
    if (\count($parts) <= 1) {
        return '';
    }

    return implode('\\', \array_slice($parts, 0, -1));
}

/**
 * @template T
 *
 * @param list<list<T>> $array
 *
 * @return list<T>
 */
function array_flatten(array $array): array
{
    $results = [];
    foreach ($array as $innerArray) {
        foreach ($innerArray as $value) {
            $results[] = $value;
        }
    }

    return $results;
}

/**
 * @template A
 * @template B
 *
 * @param callable(A): list<B> $callback
 * @param list<A>              $array
 *
 * @return list<B>
 */
function array_flat_map(callable $callback, array $array): array
{
    return array_flatten(array_map($callback, $array));
}

function pathForFQCN(string $baseNs, string $fqcn): string
{
    return '/'.strtr(
        preg_replace('/^'.preg_quote($baseNs).'\\\\(.*)$/', '$1', $fqcn),
        ['\\' => '/']
    ).'.php';
}

function writeFile(FilesystemOperator $fs, string $baseNs, PhpFile $file, bool $overwrite): void
{
    AddUseInFile::visitFile($file);

    $classes = array_flat_map(function (PhpNamespace $ns): array {
        return array_map(fn (ClassType $class): string => $ns->getName().'\\'.strDef($class->getName(), ''), array_values($ns->getClasses()));
    }, array_values($file->getNamespaces()));

    if (\count($classes) <= 0) {
        throw new \RuntimeException('Impossible to write file class.');
    }
    $class = $classes[0];

    $path = pathForFQCN(baseNs: $baseNs, fqcn: $class);

    if (true === $overwrite || false === $fs->fileExists($path)) {
        $fs->write($path, $file->__toString());
    }
}
