<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractStrictUserField
{
    /**
     * Get a user with id.
     */
    public function resolve(User $id): User
    {
        return $id;
    }
}
