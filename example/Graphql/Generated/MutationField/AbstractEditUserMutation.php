<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\MutationField;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType;

abstract class AbstractEditUserMutation
{
	/**
	 * Create an User
	 */
	abstract public function resolve(EditUserInputType $data): User;
}
