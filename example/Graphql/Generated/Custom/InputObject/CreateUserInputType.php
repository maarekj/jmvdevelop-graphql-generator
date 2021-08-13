<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject;

final class CreateUserInputType
{
    public function __construct(
        public string $email,
        public string | null $lastname = null,
        public string | null $firstname = null,
    ) {
    }

    public function _withEmail(string $email): CreateUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType(email: $email, lastname: $this->lastname, firstname: $this->firstname);
    }

    public function _withLastname(string | null $lastname): CreateUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType(email: $this->email, lastname: $lastname, firstname: $this->firstname);
    }

    public function _withFirstname(string | null $firstname): CreateUserInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType(email: $this->email, lastname: $this->lastname, firstname: $firstname);
    }
}
