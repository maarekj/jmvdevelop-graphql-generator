<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql;

use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\AbstractSchema;

final class Schema extends AbstractSchema
{
    public function schema(): \GraphQL\Type\Schema
    {
        return new \GraphQL\Type\Schema([
            'query' => $this->query(),
            'mutation' => $this->mutation(),
        ]);
    }
}
