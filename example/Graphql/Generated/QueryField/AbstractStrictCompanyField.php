<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Company;

abstract class AbstractStrictCompanyField
{
    /**
     * Get a company with id (strict).
     */
    public function resolve(Company $id): Company
    {
        return $id;
    }
}
