<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use GraphQL\Language\Source;
use Symfony\Component\Finder\Finder;
use function Psl\Type\instance_of;
use function Psl\Type\vec;

final class SymfonyQueryFinder implements QueryFinder
{
    public function __construct(private Finder $finder)
    {
    }

    /** @return iterable<Source|string> */
    public function findQueries(): iterable
    {
        $files = vec(instance_of(\SplFileInfo::class))
            ->coerce($this->finder->getIterator())
        ;

        foreach ($files as $file) {
            $path = $file->getRealPath();
            if (false !== $path) {
                $content = file_get_contents($path);
                if (false !== $content) {
                    yield new Source($content, $path);
                }
            }
        }
    }
}
