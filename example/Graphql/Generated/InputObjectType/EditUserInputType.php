<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;

final class EditUserInputType
{
    public function __construct(
        public User $id,
        public string $email,
        public string|null $lastname = null,
        public string|null $firstname = null,
    ) {
    }

    public function _withId(User $id): EditUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: $id, email: $this->email, lastname: $this->lastname, firstname: $this->firstname);
    }

    public function _withEmail(string $email): EditUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: $this->id, email: $email, lastname: $this->lastname, firstname: $this->firstname);
    }

    public function _withLastname(string|null $lastname): EditUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: $this->id, email: $this->email, lastname: $lastname, firstname: $this->firstname);
    }

    public function _withFirstname(string|null $firstname): EditUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: $this->id, email: $this->email, lastname: $this->lastname, firstname: $firstname);
    }
}
