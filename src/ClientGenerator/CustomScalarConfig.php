<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

final class CustomScalarConfig implements ScalarConfig
{
    private string $psalm;

    public function __construct(
        private string $name,
        private string $php,
        ?string $psalm = null
    ) {
        $this->psalm = null === $psalm ? $this->php : $psalm;
    }

    public function getPhpType(): string
    {
        return $this->php;
    }

    public function getPsalmType(): string
    {
        return $this->psalm;
    }

    public function name(): string
    {
        return $this->name;
    }
}
