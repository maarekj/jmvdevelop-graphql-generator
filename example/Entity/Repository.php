<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

/**
 * @template TEntity
 */
abstract class Repository
{
    /**
     * @param array<int, TEntity> $entities
     */
    public function __construct(
        private array $entities = [],
    ) {
    }

    /** @param TEntity $entity */
    abstract public function entityGetId($entity): int;

    public function nextId(): int
    {
        return max(
            array_merge([0], array_map(
                    /** @param TEntity $o */
                    function ($o): int {
                        return $this->entityGetId($o);
                    },
                $this->findAll()
            ))
        ) + 1;
    }

    /** @param TEntity $entity */
    public function add($entity): void
    {
        $this->entities[$this->entityGetId($entity)] = $entity;
    }

    /** @param TEntity $entity */
    public function remove($entity): void
    {
        unset($this->entities[$this->entityGetId($entity)]);
    }

    /** @return null|TEntity */
    public function find(int $id)
    {
        return $this->entities[$id] ?? null;
    }

    /** @return list<TEntity> */
    public function findAll(): array
    {
        return array_values($this->entities);
    }
}
