<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Interface;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractWithIdType
{
    /**
     * Object with id.
     */
    abstract public function resolveType(User | Category | Company $value): Type;
}
