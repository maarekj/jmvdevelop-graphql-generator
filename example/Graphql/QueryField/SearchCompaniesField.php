<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField;

use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Pager;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\QueryField\AbstractSearchCompaniesField;

final class SearchCompaniesField extends AbstractSearchCompaniesField
{
    public function __construct(private CompanyRepo $repo)
    {
    }

    /**
     * Search companies.
     *
     * @return null|Pager<Company>
     */
    public function resolve(?SearchCompanyWhereInputType $where): Pager | null
    {
        $results = \array_values(\array_filter($this->repo->findAll(), function (Company $company) use ($where): bool {
            if (null === $where) {
                return true;
            }

            if ('YES' === $where->withCategory) {
                return \count($company->getCategories()) > 0;
            } elseif ('NO' === $where->withCategory) {
                return \count($company->getCategories()) <= 0;
            }

            $name = $where->name;
            if (null !== $name) {
                $eq = $name->eq;
                $neq = $name->neq;
                if (null !== $eq) {
                    return $eq === $company->getName();
                }
                if (null !== $neq) {
                    return $neq !== $company->getName();
                }
            }

            $id = $where->id;
            if (null !== $id) {
                $eq = $id->eq;
                $neq = $id->neq;
                if (null !== $eq) {
                    return $eq === $company->getId();
                }
                if (null !== $neq) {
                    return $neq !== $company->getId();
                }
            }

            return true;
        }));

        return new Pager(
            currentPage: 1,
            nbPages: 1,
            count: \count($results),
            maxPerPage: 20,
            results: $results,
        );
    }
}
