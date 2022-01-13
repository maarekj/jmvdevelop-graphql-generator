<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object;

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Entity\UserRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Object\AbstractCompanyType;

final class CompanyType extends AbstractCompanyType
{
    public function __construct(
        private UserRepo $userRepo,
        private CategoryRepo $categoryRepo,
    ) {
    }

    /** @return list<Category> */
    public function resolveCategories(Company $root): array
    {
        return array_values(array_filter(array_map(fn ($id) => $this->categoryRepo->find($id), $root->getCategories())));
    }

    /** @return list<Category> */
    public function resolveSearchCategories(Company $root, ?string $name, ?array $keywords, string $orderBy): array|null
    {
        return array_values(array_filter(array_map(fn ($id) => $this->categoryRepo->find($id), $root->getCategories())));
    }

    public function resolveUser(Company $root): User|null
    {
        $id = $root->getUser();

        return null === $id ? null : $this->userRepo->find($id);
    }
}
