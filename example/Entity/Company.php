<?php

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

final class Company
{
    /** @param list<int> $categories */
    public function __construct(
        private int $id,
        private string $name,
        private array $categories,
        private ?int $user = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /** @return int[] */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(?int $user): self
    {
        $this->user = $user;

        return $this;
    }
}
