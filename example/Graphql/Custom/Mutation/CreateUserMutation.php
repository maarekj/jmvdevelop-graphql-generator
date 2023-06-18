<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Mutation;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Entity\UserRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Mutation\AbstractCreateUserMutation;
use function JmvDevelop\GraphqlGenerator\Utils\strDef;

final class CreateUserMutation extends AbstractCreateUserMutation
{
    public function __construct(private readonly UserRepo $repo)
    {
    }

    public function resolve(CreateUserInputType $data): User
    {
        $user = new User(
            id: $this->repo->nextId(),
            lastname: strDef($data->lastname, ''),
            firstname: strDef($data->firstname, ''),
            email: $data->email,
        );

        $this->repo->add($user);

        return $user;
    }
}
