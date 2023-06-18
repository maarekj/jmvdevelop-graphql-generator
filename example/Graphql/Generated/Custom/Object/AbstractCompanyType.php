<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Object;

use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;

abstract class AbstractCompanyType
{
    public function resolveId(Company $root): string|int
    {
        return $root->getId();
    }

    public function resolveName(Company $root): string
    {
        return $root->getName();
    }

    /**
     * The manager of company.
     */
    abstract public function resolveUser(Company $root): User|null;

    /**
     * All categories of company.
     *
     * @return list<\JmvDevelop\GraphqlGenerator\Example\Entity\Category>
     */
    abstract public function resolveCategories(Company $root): array;

    /**
     * Search categories of company.
     *
     * @param  null|list<null|string>                                               $keywords
     * @return null|list<null|\JmvDevelop\GraphqlGenerator\Example\Entity\Category>
     */
    abstract public function resolveSearchCategories(
        Company $root,
        string|null $name,
        array|null $keywords,
        string $orderBy,
    ): array|null;
}
