<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

/**
 * @extends Repository<Company>
 */
final class CompanyRepo extends Repository
{
    /** @param Company $entity */
    public function entityGetId($entity): int
    {
        return $entity->getId();
    }
}
