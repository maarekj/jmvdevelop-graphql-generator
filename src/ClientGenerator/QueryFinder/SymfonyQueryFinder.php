<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use GraphQL\Language\Source;
use Symfony\Component\Finder\Finder;

final class SymfonyQueryFinder implements QueryFinder
{
    public function __construct(private Finder $finder)
    {
    }

    /** @return iterable<Source|string> */
    public function findQueries(): iterable
    {
        foreach ($this->finder->getIterator() as $file) {
            $path = $file->getRealPath();
            if (false !== $path) {
                $content = \file_get_contents($path);
                if (false !== $content) {
                    yield new Source($content, $path);
                }
            }
        }
    }
}
