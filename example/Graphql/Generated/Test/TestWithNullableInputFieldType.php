<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test;

final class TestWithNullableInputFieldType
{
    public function __construct(
        public TestInputWithStringFieldType | null $nullableField,
        public TestInputWithStringFieldType $field,
    ) {
    }
}
