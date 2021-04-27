<?php

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
