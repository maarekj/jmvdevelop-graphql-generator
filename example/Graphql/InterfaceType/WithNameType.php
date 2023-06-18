<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\InterfaceType;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InterfaceType\AbstractWithNameType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;

final class WithNameType extends AbstractWithNameType
{
    public function __construct(private readonly Schema $schema)
    {
    }

    public function resolveType(Category|Company $value): Type
    {
        if ($value instanceof Category) {
            return $this->schema->get_object_type_Category();
        }

        return $this->schema->get_object_type_Company();
    }
}
