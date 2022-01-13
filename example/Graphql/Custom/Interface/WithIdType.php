<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Interface;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Interface\AbstractWithIdType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;

final class WithIdType extends AbstractWithIdType
{
    public function __construct(private Schema $schema)
    {
    }

    public function resolveType(User|Category|Company $value): Type
    {
        if ($value instanceof User) {
            return $this->schema->get_object_type_User();
        } elseif ($value instanceof Category) {
            return $this->schema->get_object_type_Category();
        }

        return $this->schema->get_object_type_Company();
    }
}
