<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

/** @extends Repository<Category> */
final class CategoryRepo extends Repository
{
    /** @param Category $entity */
    public function entityGetId($entity): int
    {
        return $entity->getId();
    }
}
