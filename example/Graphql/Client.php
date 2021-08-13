<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql;

use GraphQL\GraphQL;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\AbstractClient;

final class Client extends AbstractClient
{
    public function __construct(Mapper $mapper, private Schema $schema)
    {
        parent::__construct(mapper: $mapper);
    }

    public function execute(string $query, array $variables = []): array
    {
        $result = GraphQL::executeQuery(
            schema: $this->schema->schema(),
            source: $query,
            variableValues: $variables,
        );

        if (null !== $result->data) {
            return $result->data;
        }

        throw new \RuntimeException('Error with graphql : '.$result->jsonSerialize());
    }
}
