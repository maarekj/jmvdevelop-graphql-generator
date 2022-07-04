<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test;

abstract class AbstractTestWithNullableInputFieldMutation
{
    abstract public function resolve(TestWithNullableInputFieldType|null $data): bool;
}
