<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class EditUserInput
{
    public function __construct(
        public int $id,
        public string $email,
        public string|null $lastname = null,
        public string|null $firstname = null,
    ) {
    }

    public function _withId(int $id): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\EditUserInput(id: $id, email: $this->email, lastname: $this->lastname, firstname: $this->firstname);
    }

    public function _withEmail(string $email): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\EditUserInput(id: $this->id, email: $email, lastname: $this->lastname, firstname: $this->firstname);
    }

    public function _withLastname(string|null $lastname): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\EditUserInput(id: $this->id, email: $this->email, lastname: $lastname, firstname: $this->firstname);
    }

    public function _withFirstname(string|null $firstname): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\EditUserInput(id: $this->id, email: $this->email, lastname: $this->lastname, firstname: $firstname);
    }
}
