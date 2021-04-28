<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ObjectType;

use JmvDevelop\GraphqlGenerator\Example\Entity\Pager;

abstract class AbstractPagerCompanyType
{
    /**
     * @param \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company> $root
     */
    public function resolveCurrentPage(Pager $root): int
    {
        return $root->getCurrentPage();
    }

    /**
     * @param \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company> $root
     */
    public function resolveMaxPerPage(Pager $root): int
    {
        return $root->getMaxPerPage();
    }

    /**
     * @param \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company> $root
     */
    public function resolveNbPages(Pager $root): int
    {
        return $root->getNbPages();
    }

    /**
     * @param \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company> $root
     */
    public function resolveCount(Pager $root): int
    {
        return $root->getCount();
    }

    /**
     * @param \JmvDevelop\GraphqlGenerator\Example\Entity\Pager<\JmvDevelop\GraphqlGenerator\Example\Entity\Company> $root
     *
     * @return list<\JmvDevelop\GraphqlGenerator\Example\Entity\Company>
     */
    public function resolveResults(Pager $root): array
    {
        return $root->getResults();
    }
}
