<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Scalar;

use GraphQL\Language\AST\Node;

abstract class AbstractDateTimeTzType
{
    abstract public function serialize(\DateTimeImmutable $value): string|int|float|bool|null;

    abstract public function parseValue(string|int|float|bool|null $value): \DateTimeImmutable;

    abstract public function parseLiteral(Node $valueNode, ?array $variables): \DateTimeImmutable;
}
