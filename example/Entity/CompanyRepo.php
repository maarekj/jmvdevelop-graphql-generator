<?php

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

final class CompanyRepo
{
    /**
     * @param array<int, Company> $entities
     */
    public function __construct(
        private array $entities = [],
    ) {
    }

    public function nextId(): int
    {
        return \max(
            \array_merge([0], \array_map(function (Company $o): int {
                return $o->getId();
            }, $this->findAll()))
        ) + 1;
    }

    public function add(Company $company): void
    {
        $this->entities[$company->getId()] = $company;
    }

    public function remove(Company $company): void
    {
        unset($this->entities[$company->getId()]);
    }

    public function find(int $id): ?Company
    {
        return $this->entities[$id] ?? null;
    }

    /** @return list<Company> */
    public function findAll(): array
    {
        return \array_values($this->entities);
    }
}
