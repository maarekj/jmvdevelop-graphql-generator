<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

abstract class AbstractUsersField
{
	/**
	 * Get all users
	 *
	 * @return list<\JmvDevelop\GraphqlGenerator\Example\Entity\User>
	 */
	abstract public function resolve(): array;
}
