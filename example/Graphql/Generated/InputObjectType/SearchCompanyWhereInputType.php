<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class SearchCompanyWhereInputType
{
    /**
     * @psalm-param list<\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType|null>|null $_and
     * @psalm-param list<\JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType|null>|null $_or
     * @psalm-param 'YES'|'NO'|'DEFAULT'|null $withCategory
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
