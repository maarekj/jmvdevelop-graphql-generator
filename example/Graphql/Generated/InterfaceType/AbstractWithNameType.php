<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InterfaceType;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;

abstract class AbstractWithNameType
{
    /**
     * Object with string name.
     */
    abstract public function resolveType(Category | Company $value): Type;
}
