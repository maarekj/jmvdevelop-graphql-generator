<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

final class User
{
    public function __construct(
        private int $id,
        private string $lastname,
        private string $firstname,
        private string $email,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
