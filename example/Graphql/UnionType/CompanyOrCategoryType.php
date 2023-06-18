<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\UnionType;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\UnionType\AbstractCompanyOrCategoryType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;

final class CompanyOrCategoryType extends AbstractCompanyOrCategoryType
{
    public function __construct(private readonly Schema $schema)
    {
    }

    public function resolveType(Category|Company $value): Type
    {
        if ($value instanceof Company) {
            return $this->schema->get_object_type_Company();
        } elseif ($value instanceof Category) {
            return $this->schema->get_object_type_Category();
        }

        throw new \RuntimeException('impossible');
    }
}
