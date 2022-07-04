<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractUserField
{
    /**
     * Get a user with id.
     */
    public function resolve(User $id): User|null
    {
        return $id;
    }
}
