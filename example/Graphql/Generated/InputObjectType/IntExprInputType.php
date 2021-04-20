<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class IntExprInputType
{
    public function __construct(
        public int | null $eq,
        public int | null $neq,
        public int | null $gt,
        public int | null $gte,
        public int | null $lt,
        public int | null $lte,
    ) {
    }
}
