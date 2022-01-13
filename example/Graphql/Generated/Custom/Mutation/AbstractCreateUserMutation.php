<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Mutation;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType;

abstract class AbstractCreateUserMutation
{
	/**
	 * Create an User
	 */
	abstract public function resolve(CreateUserInputType $data): User;
}
