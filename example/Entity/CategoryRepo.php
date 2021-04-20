<?php

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

final class CategoryRepo
{
    /**
     * @param array<int, Category> $entities
     */
    public function __construct(
        private array $entities = [],
    ) {
    }

    public function nextId(): int
    {
        return \max(
            \array_merge([0], \array_map(function (Category $o): int {
                return $o->getId();
            }, $this->findAll()))
        ) + 1;
    }

    public function add(Category $category): void
    {
        $this->entities[$category->getId()] = $category;
    }

    public function remove(Category $category): void
    {
        unset($this->entities[$category->getId()]);
    }

    public function find(int $id): ?Category
    {
        return $this->entities[$id] ?? null;
    }

    /** @return list<Category> */
    public function findAll(): array
    {
        return \array_values($this->entities);
    }
}
