<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType;

use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Entity\UserRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType\AbstractUserIdType;

final class UserIdType extends AbstractUserIdType
{
    public function __construct(private readonly UserRepo $repo)
    {
    }

    public function serialize(User $value): string|int|float|null|bool
    {
        return $value->getId();
    }

    public function parseValue(float|int|string|null|bool $value): User
    {
        if (\is_int($value)) {
            $entity = $this->repo->find($value);
            if (null === $entity) {
                throw new Error('Entity not found');
            }

            return $entity;
        }

        throw new Error('Invalid type');
    }

    /** @param null|array<mixed, mixed> $variables */
    public function parseLiteral(Node $valueNode, ?array $variables): User
    {
        if (!$valueNode instanceof IntValueNode) {
            throw new Error('Query error: Can only parse ints got: '.$valueNode->kind, [$valueNode]);
        }

        $entity = $this->repo->find((int) $valueNode->value);
        if (null === $entity) {
            throw new Error('Entity not found');
        }

        return $entity;
    }
}
