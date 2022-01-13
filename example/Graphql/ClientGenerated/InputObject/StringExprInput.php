<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class StringExprInput
{
	public function __construct(
		public string|null $eq = null,
		public string|null $neq = null,
		public string|null $like = null,
	) {
	}


	public function _withEq(string|null $eq): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\StringExprInput(eq: $eq, neq: $this->neq, like: $this->like);
	}


	public function _withNeq(string|null $neq): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\StringExprInput(eq: $this->eq, neq: $neq, like: $this->like);
	}


	public function _withLike(string|null $like): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\StringExprInput(eq: $this->eq, neq: $this->neq, like: $like);
	}
}
