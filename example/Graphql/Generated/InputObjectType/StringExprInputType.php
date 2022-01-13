<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class StringExprInputType
{
	public function __construct(
		public string|null $eq = null,
		public string|null $neq = null,
		public string|null $like = null,
	) {
	}


	public function _withEq(string|null $eq): StringExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\StringExprInputType(eq: $eq, neq: $this->neq, like: $this->like);
	}


	public function _withNeq(string|null $neq): StringExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\StringExprInputType(eq: $this->eq, neq: $neq, like: $this->like);
	}


	public function _withLike(string|null $like): StringExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\StringExprInputType(eq: $this->eq, neq: $this->neq, like: $like);
	}
}
