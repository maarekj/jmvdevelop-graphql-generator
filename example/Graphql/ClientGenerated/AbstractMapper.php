<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated;

use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\CreateUserInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\EditUserInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\StringExprInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\TestInputWithStringField;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\TestWithNullableInputField;

abstract class AbstractMapper
{
    public function php_to_graphql_String(string $data)
    {
        return $data;
    }

    public function graphql_to_php_String($data): string
    {
        return $data;
    }

    abstract public function php_to_graphql_OrderDirection($data);

    abstract public function graphql_to_php_OrderDirection($data);

    public function php_to_graphql_SearchCompanyWhereInput(SearchCompanyWhereInput $data): array
    {
        return [
            '_and' => null === $data->_and ? null : array_map(fn ($_value) => null === $_value ? null : $this->php_to_graphql_SearchCompanyWhereInput($_value), $data->_and),
            '_or' => null === $data->_or ? null : array_map(fn ($_value) => null === $_value ? null : $this->php_to_graphql_SearchCompanyWhereInput($_value), $data->_or),
            'name' => null === $data->name ? null : $this->php_to_graphql_StringExprInput($data->name),
            'id' => null === $data->id ? null : $this->php_to_graphql_IntExprInput($data->id),
            'withCategory' => null === $data->withCategory ? null : $this->php_to_graphql_YesNo($data->withCategory),
        ];
    }

    public function php_to_graphql_StringExprInput(StringExprInput $data): array
    {
        return [
            'eq' => null === $data->eq ? null : $this->php_to_graphql_String($data->eq),
            'neq' => null === $data->neq ? null : $this->php_to_graphql_String($data->neq),
            'like' => null === $data->like ? null : $this->php_to_graphql_String($data->like),
        ];
    }

    public function php_to_graphql_IntExprInput(IntExprInput $data): array
    {
        return [
            'eq' => null === $data->eq ? null : $this->php_to_graphql_Int($data->eq),
            'neq' => null === $data->neq ? null : $this->php_to_graphql_Int($data->neq),
            'gt' => null === $data->gt ? null : $this->php_to_graphql_Int($data->gt),
            'gte' => null === $data->gte ? null : $this->php_to_graphql_Int($data->gte),
            'lt' => null === $data->lt ? null : $this->php_to_graphql_Int($data->lt),
            'lte' => null === $data->lte ? null : $this->php_to_graphql_Int($data->lte),
        ];
    }

    public function php_to_graphql_Int(int $data)
    {
        return $data;
    }

    public function graphql_to_php_Int($data): int
    {
        return $data;
    }

    abstract public function php_to_graphql_YesNo($data);

    abstract public function graphql_to_php_YesNo($data);

    public function php_to_graphql_ID(string $data)
    {
        return $data;
    }

    public function graphql_to_php_ID($data): string
    {
        return $data;
    }

    abstract public function php_to_graphql_CompanyId(int $data);

    abstract public function graphql_to_php_CompanyId($data): int;

    abstract public function php_to_graphql_CategoryId(int $data);

    abstract public function graphql_to_php_CategoryId($data): int;

    abstract public function php_to_graphql_UserId(int $data);

    abstract public function graphql_to_php_UserId($data): int;

    public function php_to_graphql_CreateUserInput(CreateUserInput $data): array
    {
        return [
            'email' => $this->php_to_graphql_String($data->email),
            'lastname' => null === $data->lastname ? null : $this->php_to_graphql_String($data->lastname),
            'firstname' => null === $data->firstname ? null : $this->php_to_graphql_String($data->firstname),
        ];
    }

    public function php_to_graphql_EditUserInput(EditUserInput $data): array
    {
        return [
            'id' => $this->php_to_graphql_UserId($data->id),
            'email' => $this->php_to_graphql_String($data->email),
            'lastname' => null === $data->lastname ? null : $this->php_to_graphql_String($data->lastname),
            'firstname' => null === $data->firstname ? null : $this->php_to_graphql_String($data->firstname),
        ];
    }

    public function php_to_graphql_TestWithNullableInputField(TestWithNullableInputField $data): array
    {
        return [
            'nullableField' => null === $data->nullableField ? null : $this->php_to_graphql_TestInputWithStringField($data->nullableField),
            'field' => $this->php_to_graphql_TestInputWithStringField($data->field),
        ];
    }

    public function php_to_graphql_TestInputWithStringField(TestInputWithStringField $data): array
    {
        return [
            'name' => $this->php_to_graphql_String($data->name),
        ];
    }

    public function php_to_graphql_Boolean(bool $data)
    {
        return $data;
    }

    public function graphql_to_php_Boolean($data): bool
    {
        return $data;
    }

    public function php_to_graphql_Float(float $data)
    {
        return $data;
    }

    public function graphql_to_php_Float($data): float
    {
        return $data;
    }

    abstract public function php_to_graphql___TypeKind($data);

    abstract public function graphql_to_php___TypeKind($data);

    abstract public function php_to_graphql___DirectiveLocation($data);

    abstract public function graphql_to_php___DirectiveLocation($data);
}
