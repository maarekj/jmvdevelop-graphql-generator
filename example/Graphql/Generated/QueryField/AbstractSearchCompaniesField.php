<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Pager;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType;

abstract class AbstractSearchCompaniesField
{
	/**
	 * Search companies
	 *
	 * @return \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company>|null
	 */
	abstract public function resolve(SearchCompanyWhereInputType|null $where): Pager|null;
}
