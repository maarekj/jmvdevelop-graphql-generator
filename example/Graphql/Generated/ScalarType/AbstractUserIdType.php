<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType;

use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractUserIdType
{
    abstract public function serialize(User $value): string|int|float|bool|null;

    abstract public function parseValue(string|int|float|bool|null $value): User;

    /**
     * @param null|array<mixed, mixed> $variables
     */
    abstract public function parseLiteral(Node $valueNode, ?array $variables): User;
}
