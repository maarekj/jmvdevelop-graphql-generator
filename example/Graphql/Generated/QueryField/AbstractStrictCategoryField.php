<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;

abstract class AbstractStrictCategoryField
{
    /**
     * Get a category with id.
     */
    public function resolve(Category $id): Category
    {
        return $id;
    }
}
