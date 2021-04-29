<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Entity;

/**
 * @template T
 */
final class Pager
{
    /**
     * @param list<T> $results
     */
    public function __construct(
        private int $currentPage,
        private int $maxPerPage,
        private int $nbPages,
        private int $count,
        private array $results,
    ) {
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getMaxPerPage(): int
    {
        return $this->maxPerPage;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    /** @return list<T> */
    public function getResults(): array
    {
        return $this->results;
    }
}
