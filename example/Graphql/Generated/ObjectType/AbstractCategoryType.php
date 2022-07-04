<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ObjectType;

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;

abstract class AbstractCategoryType
{
    public function resolveId(Category $root): string|int
    {
        return $root->getId();
    }

    public function resolveName(Category $root): string
    {
        return $root->getName();
    }
}
