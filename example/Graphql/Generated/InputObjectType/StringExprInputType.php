<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class StringExprInputType
{
    public function __construct(
        public string | null $eq,
        public string | null $neq,
        public string | null $like,
    ) {
    }
}
