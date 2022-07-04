<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\ScalarType;

use GraphQL\Language\AST\Node;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;

abstract class AbstractCompanyIdType
{
    abstract public function serialize(Company $value): string|int|float|bool|null;

    abstract public function parseValue(string|int|float|bool|null $value): Company;

    abstract public function parseLiteral(Node $valueNode, ?array $variables): Company;
}
