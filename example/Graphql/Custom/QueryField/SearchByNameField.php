<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\QueryField\AbstractSearchByNameField;

final class SearchByNameField extends AbstractSearchByNameField
{
    public function __construct(private CategoryRepo $categoryRepo, private CompanyRepo $companyRepo)
    {
    }

    /**
     * @param 'ASC'|'DESC'|'DEFAULT'|null $orderByName
     *
     * @return list<Category|Company>
     */
    public function resolve(?string $name, string | null $orderByName): array
    {
        $results = [];

        foreach ($this->categoryRepo->findAll() as $category) {
            if (null === $name || false !== \preg_match('/'.$name.'/', $category->getName())) {
                $results[] = $category;
            }
        }

        foreach ($this->companyRepo->findAll() as $company) {
            if (null === $name || false !== \preg_match('/'.$name.'/', $company->getName())) {
                $results[] = $company;
            }
        }

        if ('ASC' === $orderByName) {
            \usort($results, fn (Category | Company $a, Category | Company $b) => $a->getName() <=> $b->getName());
        } elseif ('DESC' === $orderByName) {
            \usort($results, fn (Category | Company $a, Category | Company $b) => $b->getName() <=> $a->getName());
        }

        return $results;
    }
}
