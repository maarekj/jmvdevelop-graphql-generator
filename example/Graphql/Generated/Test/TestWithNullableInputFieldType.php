<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test;

final class TestWithNullableInputFieldType
{
    public function __construct(
        public TestInputWithStringFieldType | null $nullableField = null,
        public TestInputWithStringFieldType $field,
    ) {
    }

    public function _withNullableField(TestInputWithStringFieldType | null $nullableField): TestWithNullableInputFieldType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestWithNullableInputFieldType(nullableField: $nullableField, field: $this->field);
    }

    public function _withField(TestInputWithStringFieldType $field): TestWithNullableInputFieldType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestWithNullableInputFieldType(nullableField: $this->nullableField, field: $field);
    }
}
