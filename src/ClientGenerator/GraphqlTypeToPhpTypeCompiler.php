<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Language\AST\FieldNode;
use GraphQL\Language\AST\ListTypeNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\NonNullTypeNode;
use GraphQL\Language\AST\SelectionNode;
use GraphQL\Language\AST\SelectionSetNode;
use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\EnumValueDefinition;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils\AST;
use Nette\PhpGenerator\Dumper;
use Webmozart\Assert\Assert;

final class GraphqlTypeToPhpTypeCompiler
{
    public function __construct(private Config $config)
    {
    }

    public function compileTypeNodeToPhpType(NamedTypeNode|ListTypeNode|NonNullTypeNode $typeNode, bool $forceCanBeNull, bool $canBeNull = true): string
    {
        $type = AST::typeFromAST($this->config->getSchema(), $typeNode);
        Assert::notNull($type);

        return $this->compileTypeToPhpType(type: $type, forceCanBeNull: $forceCanBeNull);
    }

    public function compileTypeToPhpType(Type $type, bool $forceCanBeNull = false, bool $canBeNull = true): string
    {
        $orNull = ($canBeNull ? '|null' : '');

        if ($type instanceof NonNull) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            if ($forceCanBeNull) {
                return $this->compileTypeToPhpType(type: $ofType, canBeNull: true, forceCanBeNull: false);
            }

            return $this->compileTypeToPhpType(type: $ofType, canBeNull: false, forceCanBeNull: false);
        } elseif ($type instanceof ListOfType) {
            return 'array'.$orNull;
        } elseif ($type instanceof ScalarType) {
            $scalarConfig = $this->config->getScalarConfigOrThrow($type->name);

            return $scalarConfig->getPhpType().$orNull;
        } elseif ($type instanceof InputObjectType) {
            $inputClass = '\\'.$this->config->getNamespace().'\\ClientGenerated\\InputObject\\'.$type->name;

            return $inputClass.$orNull;
        } elseif ($type instanceof EnumType) {
            return 'string'.$orNull;
        }

        return 'array'.$orNull;
    }

    public function compileTypeNodeToPsalmType(NamedTypeNode|ListTypeNode|NonNullTypeNode $typeNode, bool $forceCanBeNull): string
    {
        $type = AST::typeFromAST($this->config->getSchema(), $typeNode);
        Assert::notNull($type);

        return $this->compileTypeToPsalmType(type: $type, forceCanBeNull: $forceCanBeNull);
    }

    public function compileTypeToPsalmType(Type $type, bool $forceCanBeNull = false, bool $canBeNull = true): string
    {
        $dumper = new Dumper();

        $orNull = ($canBeNull ? '|null' : '');

        if ($type instanceof NonNull) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            if ($forceCanBeNull) {
                return $this->compileTypeToPsalmType(type: $ofType, canBeNull: true, forceCanBeNull: false);
            }

            return $this->compileTypeToPsalmType(type: $ofType, canBeNull: false, forceCanBeNull: false);
        } elseif ($type instanceof ListOfType) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return 'list<'.$this->compileTypeToPsalmType(type: $ofType, forceCanBeNull: false).'>'.$orNull;
        } elseif ($type instanceof ScalarType) {
            $scalarConfig = $this->config->getScalarConfigOrThrow($type->name);

            return $scalarConfig->getPsalmType().$orNull;
        } elseif ($type instanceof InputObjectType) {
            $inputClass = '\\'.$this->config->getNamespace().'\\ClientGenerated\\InputObject\\'.$type->name;

            return $inputClass.$orNull;
        } elseif ($type instanceof EnumType) {
            $values = array_map(
                fn (EnumValueDefinition $value): string => $dumper->dump($value->value),
                $type->getValues()
            );

            return implode('|', $values).$orNull;
        }

        return 'array'.$orNull;
    }

    public function compileSelectionSetToPsalmType(SelectionSetNode $set, ObjectType $baseType, bool $canBeNull): string
    {
        $res = array_map(function (SelectionNode $selection) use ($baseType): string {
            return $this->compileSelectionToPsalmType(selection: $selection, baseType: $baseType);
        }, iterator_to_array($set->selections));

        $orNull = ($canBeNull ? '|null' : '');

        return 'array{'.implode(', ', $res).'}'.$orNull;
    }

    public function compileSelectionToPsalmType(SelectionNode $selection, ObjectType $baseType): string
    {
        if ($selection instanceof FieldNode) {
            return $this->compileSelectionFieldNodeToPsalmType(field: $selection, baseType: $baseType);
        }

        throw new \RuntimeException('@TODO');
    }

    private function compileSelectionFieldNodeToPsalmType(FieldNode $field, ObjectType $baseType): string
    {
        $alias = $field->alias;
        $name = $field->name->value;
        $nameOrAlias = null !== $alias ? $alias->value : $name;

        $res = ':nameOrAlias: :sub';

        if ('__typename' === $name) {
            $sub = 'string';
        } else {
            $fieldDefinition = $baseType->getField($name);
            $fieldType = $fieldDefinition->getType();

            $sub = $this->compileTypeWithFieldNodeToPsalmType(type: $fieldType, field: $field);
        }

        return strtr($res, [
            ':nameOrAlias' => $nameOrAlias,
            ':sub' => $sub,
        ]);
    }

    private function compileTypeWithFieldNodeToPsalmType(Type $type, FieldNode $field, bool $canBeNull = true): string
    {
        if ($type instanceof ScalarType) {
            return $this->compileTypeToPsalmType(type: $type, canBeNull: $canBeNull);
        } elseif ($type instanceof NonNull) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return $this->compileTypeWithFieldNodeToPsalmType(field: $field, type: $ofType, canBeNull: false);
        } elseif ($type instanceof ListOfType) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return 'list<'.$this->compileTypeWithFieldNodeToPsalmType(field: $field, type: $ofType).'>';
        } elseif ($type instanceof ObjectType) {
            $set = $field->selectionSet;
            Assert::notNull($set);

            return $this->compileSelectionSetToPsalmType(set: $set, baseType: $type, canBeNull: $canBeNull);
        }

        throw new \RuntimeException('@TODO');
    }
}
