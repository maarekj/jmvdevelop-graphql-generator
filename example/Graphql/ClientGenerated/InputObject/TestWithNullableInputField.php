<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class TestWithNullableInputField
{
	public function __construct(
		public TestInputWithStringField $field,
		public TestInputWithStringField|null $nullableField = null,
	) {
	}


	public function _withField(TestInputWithStringField $field): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\TestWithNullableInputField(nullableField: $this->nullableField, field: $field);
	}


	public function _withNullableField(TestInputWithStringField|null $nullableField): self
	{
		return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\TestWithNullableInputField(nullableField: $nullableField, field: $this->field);
	}
}
