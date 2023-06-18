<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\UserRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField\AbstractUsersField;

final class UsersField extends AbstractUsersField
{
    public function __construct(private readonly UserRepo $repo)
    {
    }

    public function resolve(): array
    {
        return $this->repo->findAll();
    }
}
