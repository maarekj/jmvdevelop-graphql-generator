<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

abstract class AbstractCompaniesAndCategoriesField
{
	/**
	 * @return list<\JmvDevelop\GraphqlGenerator\Example\Entity\Company|\JmvDevelop\GraphqlGenerator\Example\Entity\Category>
	 */
	abstract public function resolve(): array;
}
