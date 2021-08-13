<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use GraphQL\Language\Source;

interface QueryFinder
{
    /** @return iterable<Source|string> */
    public function findQueries(): iterable;
}
