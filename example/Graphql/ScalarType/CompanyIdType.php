<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType;

use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType\AbstractCompanyIdType;

final class CompanyIdType extends AbstractCompanyIdType
{
    public function __construct(private CompanyRepo $repo)
    {
    }

    public function serialize(Company $value): string|int|float|null|bool
    {
        return $value->getId();
    }

    public function parseValue(float|int|string|null|bool $value): Company
    {
        if (null !== $value && \is_int($value)) {
            $entity = $this->repo->find($value);
            if (null === $entity) {
                throw new Error('Entity not found');
            }

            return $entity;
        }

        throw new Error('Invalid type');
    }

    public function parseLiteral(Node $valueNode, ?array $variables): Company
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
