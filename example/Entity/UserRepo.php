<?php

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

final class UserRepo
{
    /**
     * @param array<int, User> $entities
     */
    public function __construct(
        private array $entities = [],
    ) {
    }

    public function nextId(): int
    {
        return \max(
            \array_merge([0], \array_map(function (User $o): int {
                return $o->getId();
            }, $this->findAll()))
        ) + 1;
    }

    public function add(User $user): void
    {
        $this->entities[$user->getId()] = $user;
    }

    public function remove(User $user): void
    {
        unset($this->entities[$user->getId()]);
    }

    public function find(int $id): ?User
    {
        return $this->entities[$id] ?? null;
    }

    /** @return list<User> */
    public function findAll(): array
    {
        return \array_values($this->entities);
    }
}
