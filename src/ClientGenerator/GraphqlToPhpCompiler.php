<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Language\AST\FieldNode;
use GraphQL\Language\AST\SelectionNode;
use GraphQL\Language\AST\SelectionSetNode;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Nette\PhpGenerator\Dumper;
use Webmozart\Assert\Assert;

final class GraphqlToPhpCompiler
{
    private Dumper $dumper;

    public function __construct(Schema $schema)
    {
        $this->dumper = new Dumper();
    }

    public function compileSelectionSet(string $variable, SelectionSetNode $set, ObjectType $baseType): string
    {
        $res = '[
        ';

        foreach ($set->selections as $selection) {
            $res .= $this->compileSelection(variable: $variable, selection: $selection, baseType: $baseType).',';
        }

        $res .= '
        ]';

        return $res;
    }

    public function compileSelection(string $variable, SelectionNode $selection, ObjectType $baseType): string
    {
        if ($selection instanceof FieldNode) {
            return $this->compileSelectionFieldNode(variable: $variable, field: $selection, baseType: $baseType);
        }

        throw new \RuntimeException('@TODO');
    }

    private function compileSelectionFieldNode(string $variable, FieldNode $field, ObjectType $baseType): string
    {
        $alias = $field->alias;
        $name = $field->name->value;
        $nameOrAlias = null !== $alias ? $alias->value : $name;

        $res = ':nameOrAlias => (:variable) === null ? null : (function($___data) {
            return $___data === null ? null : :return;
        })((:variable)[:nameOrAlias])';

        if ('__typename' === $name) {
            $return = '$___data';
        } else {
            $fieldDefinition = $baseType->getField($name);
            $fieldType = $fieldDefinition->getType();

            $return = $this->compileType(
                variable: '$___data',
                field: $field,
                type: $fieldType
            );
        }

        return \strtr($res, [
            ':nameOrAlias' => $this->dump($nameOrAlias),
            ':variable' => $variable,
            ':return' => $return,
        ]);
    }

    private function compileType(string $variable, FieldNode $field, Type $type): string
    {
        if ($type instanceof ScalarType) {
            return '$this->mapper->graphql_to_php_'.$type->name.'('.$variable.')';
        } elseif ($type instanceof NonNull) {
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return $this->compileType(variable: $variable, field: $field, type: $ofType);
        } elseif ($type instanceof ListOfType) {
            $res = 'array_map(function($___data) {
                return :sub;
            }, :variable)';
            /** @var Type $ofType */
            $ofType = $type->getOfType();

            return \strtr($res, [
                ':variable' => $variable,
                ':sub' => $this->compileType(variable: '$___data', field: $field, type: $ofType),
            ]);
        } elseif ($type instanceof ObjectType) {
            $set = $field->selectionSet;
            Assert::notNull($set);

            return $this->compileSelectionSet($variable, set: $set, baseType: $type);
        }

        throw new \RuntimeException('@TODO');
    }

    private function dump(mixed $var): string
    {
        return $this->dumper->dump($var);
    }
}
