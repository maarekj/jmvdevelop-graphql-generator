<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class SearchCompanyWhereInputType
{
    /**
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_and
     * @param null|list<null|\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType> $_or
     */
    public function __construct(
        public array | null $_and,
        public array | null $_or,
        public StringExprInputType | null $name,
        public IntExprInputType | null $id,
        public string | null $withCategory,
    ) {
    }
}
