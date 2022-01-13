<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class IntExprInputType
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


	public function _withEq(int|null $eq): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withNeq(int|null $neq): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $this->eq, neq: $neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withGt(int|null $gt): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $this->eq, neq: $this->neq, gt: $gt, gte: $this->gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withGte(int|null $gte): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $gte, lt: $this->lt, lte: $this->lte);
	}


	public function _withLt(int|null $lt): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $lt, lte: $this->lte);
	}


	public function _withLte(int|null $lte): IntExprInputType
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: $this->eq, neq: $this->neq, gt: $this->gt, gte: $this->gte, lt: $this->lt, lte: $lte);
	}
}
