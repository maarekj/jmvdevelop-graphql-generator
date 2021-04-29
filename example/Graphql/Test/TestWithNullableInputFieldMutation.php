<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Test;

use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\AbstractTestWithNullableInputFieldMutation;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestWithNullableInputFieldType;

final class TestWithNullableInputFieldMutation extends AbstractTestWithNullableInputFieldMutation
{
    public function resolve(?TestWithNullableInputFieldType $data): bool
    {
        return true;
    }
}
