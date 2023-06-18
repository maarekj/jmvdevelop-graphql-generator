<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

final class IdScalarConfig implements ScalarConfig
{
    public function __construct(private string $name, private string $php)
    {
    }

    public function getPhpType(): string
    {
        return $this->php;
    }

    public function getPsalmType(): string
    {
        return $this->php;
    }

    public function name(): string
    {
        return $this->name;
    }
}
