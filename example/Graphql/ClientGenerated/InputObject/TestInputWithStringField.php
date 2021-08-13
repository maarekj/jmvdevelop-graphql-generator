<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject;

final class TestInputWithStringField
{
    public function __construct(public string $name)
    {
    }

    public function _withName(string $name): self
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\TestInputWithStringField(name: $name);
    }
}
