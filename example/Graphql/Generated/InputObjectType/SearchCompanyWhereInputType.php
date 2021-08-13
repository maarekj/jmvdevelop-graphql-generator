<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class SearchCompanyWhereInputType
{
    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_and
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_or
     * @param 'YES'|'NO'|'DEFAULT'|null                                                                                          $withCategory
     */
    public function __construct(
        public array | null $_and = null,
        public array | null $_or = null,
        public StringExprInputType | null $name = null,
        public IntExprInputType | null $id = null,
        public string | null $withCategory = null,
    ) {
    }

    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_and
     */
    public function _with_and(array | null $_and): SearchCompanyWhereInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: $_and, _or: $this->_or, name: $this->name, id: $this->id, withCategory: $this->withCategory);
    }

    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_or
     */
    public function _with_or(array | null $_or): SearchCompanyWhereInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: $this->_and, _or: $_or, name: $this->name, id: $this->id, withCategory: $this->withCategory);
    }

    public function _withName(StringExprInputType | null $name): SearchCompanyWhereInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: $this->_and, _or: $this->_or, name: $name, id: $this->id, withCategory: $this->withCategory);
    }

    public function _withId(IntExprInputType | null $id): SearchCompanyWhereInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: $this->_and, _or: $this->_or, name: $this->name, id: $id, withCategory: $this->withCategory);
    }

    /**
     * @param 'YES'|'NO'|'DEFAULT'|null $withCategory
     */
    public function _withWithCategory(string | null $withCategory): SearchCompanyWhereInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: $this->_and, _or: $this->_or, name: $this->name, id: $this->id, withCategory: $withCategory);
    }
}
