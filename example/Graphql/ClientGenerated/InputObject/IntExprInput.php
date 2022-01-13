<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class IntExprInput
{
	public function __construct(
		public int|null $eq = null,
		public int|null $neq = null,
		public int|null $gt = null,
		public int|null $gte = null,
		public int|null $lt = null,
		public int|null $lte = null,
	) {
	}


	public function _withEq(int|null $eq): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withNeq(int|null $neq): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $this->eq, neq: $neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withGt(int|null $gt): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $this->eq, neq: $this->neq, gt: $gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withGte(int|null $gte): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withLt(int|null $lt): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $lt, lte: $this->lte);
	}


	public function _withLte(int|null $lte): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $lte);
	}
}
