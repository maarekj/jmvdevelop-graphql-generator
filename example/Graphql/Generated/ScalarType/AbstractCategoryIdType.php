<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType;

use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;

abstract class AbstractCategoryIdType
{
    abstract public function serialize(Category $value): string|int|float|bool|null;

    abstract public function parseValue(string|int|float|bool|null $value): Category;

    abstract public function parseLiteral(Node $valueNode, ?array $variables): Category;
}
