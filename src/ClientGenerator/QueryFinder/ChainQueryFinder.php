<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use GraphQL\Language\Source;

final class ChainQueryFinder implements QueryFinder
{
    /**
     * @param list<QueryFinder> $finders
     */
    public function __construct(private array $finders = [])
    {
    }

    public function addFinder(QueryFinder $finder): self
    {
        $this->finders[] = $finder;

        return $this;
    }

    /** @return list<QueryFinder> */
    public function getFinders(): array
    {
        return $this->finders;
    }

    /** @return iterable<Source|string> */
    public function findQueries(): iterable
    {
        foreach ($this->finders as $finder) {
            yield from $finder->findQueries();
        }
    }
}
