<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ObjectType;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractUserType
{
	public function resolveId(User $root): string|int
	{
		return $root->getId();
	}


	public function resolveEmail(User $root): string
	{
		return $root->getEmail();
	}


	public function resolveLastname(User $root): string
	{
		return $root->getLastname();
	}


	public function resolveFirstname(User $root): string
	{
		return $root->getFirstname();
	}
}
