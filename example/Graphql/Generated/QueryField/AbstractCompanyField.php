<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Company;

abstract class AbstractCompanyField
{
    /**
     * Get a company with id.
     */
    public function resolve(Company $id): Company | null
    {
        return $id;
    }
}
