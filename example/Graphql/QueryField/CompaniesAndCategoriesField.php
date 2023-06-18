<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField\AbstractCompaniesAndCategoriesField;

final class CompaniesAndCategoriesField extends AbstractCompaniesAndCategoriesField
{
    public function __construct(private readonly CompanyRepo $companyRepo, private readonly CategoryRepo $categoryRepo)
    {
    }

    /**
     * @return list<Category|Company>
     */
    public function resolve(): array
    {
        $results = [];
        foreach ($this->companyRepo->findAll() as $company) {
            $results[] = $company;
        }
        foreach ($this->categoryRepo->findAll() as $category) {
            $results[] = $category;
        }

        return $results;
    }
}
