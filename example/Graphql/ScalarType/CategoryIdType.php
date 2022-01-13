<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType;

use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType\AbstractCategoryIdType;

final class CategoryIdType extends AbstractCategoryIdType
{
    public function __construct(private CategoryRepo $repo)
    {
    }

    public function serialize(Category $value): string|int|float|null|bool
    {
        return $value->getId();
    }

    public function parseValue(float|int|string|null|bool $value): Category
    {
        if (null !== $value && \is_int($value)) {
            $category = $this->repo->find($value);
            if (null === $category) {
                throw new Error('Entity not found');
            }

            return $category;
        }

        throw new Error('Invalid type');
    }

    public function parseLiteral(Node $valueNode, ?array $variables): Category
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
