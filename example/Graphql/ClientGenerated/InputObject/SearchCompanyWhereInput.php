<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class SearchCompanyWhereInput
{
    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput> $_and
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput> $_or
     * @param 'YES'|'NO'|'DEFAULT'|null                                                                                        $withCategory
     */
    public function __construct(
        public array | null $_and = null,
        public array | null $_or = null,
        public StringExprInput | null $name = null,
        public IntExprInput | null $id = null,
        public string | null $withCategory = null,
    ) {
    }

    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput> $_and
     */
    public function _with_and(array | null $_and): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput(_and: $_and, _or: $this->_or, name: $this->name, id: $this->id, withCategory: $this->withCategory);
    }

    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput> $_or
     */
    public function _with_or(array | null $_or): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput(_and: $this->_and, _or: $_or, name: $this->name, id: $this->id, withCategory: $this->withCategory);
    }

    public function _withName(StringExprInput | null $name): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput(_and: $this->_and, _or: $this->_or, name: $name, id: $this->id, withCategory: $this->withCategory);
    }

    public function _withId(IntExprInput | null $id): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput(_and: $this->_and, _or: $this->_or, name: $this->name, id: $id, withCategory: $this->withCategory);
    }

    /**
     * @param 'YES'|'NO'|'DEFAULT'|null $withCategory
     */
    public function _withWithCategory(string | null $withCategory): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput(_and: $this->_and, _or: $this->_or, name: $this->name, id: $this->id, withCategory: $withCategory);
    }
}
