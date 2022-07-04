<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test;

final class TestInputWithStringFieldType
{
    public function __construct(public string $name)
    {
    }

    public function _withName(string $name): TestInputWithStringFieldType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestInputWithStringFieldType(name: $name);
    }
}
