<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\UnionType;

use GraphQL\Type\Definition\Type;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;

abstract class AbstractCompanyOrCategoryType
{
    abstract public function resolveType(Company|Category $value): Type;
}
