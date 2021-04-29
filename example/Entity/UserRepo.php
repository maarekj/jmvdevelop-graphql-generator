<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

/** @extends Repository<User> */
final class UserRepo extends Repository
{
    /** @param User $entity */
    public function entityGetId($entity): int
    {
        return $entity->getId();
    }
}
