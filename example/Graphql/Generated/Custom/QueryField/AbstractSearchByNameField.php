<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\QueryField;

abstract class AbstractSearchByNameField
{
    /**
     * Search all entities with name.
     *
     * @return list<\JmvDevelop\GraphqlGenerator\Example\Entity\Category|\JmvDevelop\GraphqlGenerator\Example\Entity\Company>
     * @psalm-param 'ASC'|'DESC'|'DEFAULT'|null $orderByName
     */
    abstract public function resolve(string|null $name, string|null $orderByName): array;
}
