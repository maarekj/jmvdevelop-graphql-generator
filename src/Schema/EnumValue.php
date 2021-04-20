<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

final class EnumValue implements WithName, WithDescription
{
    private string | int | bool | float | null $value;

    public function __construct(
        private string $name,
        null | string | int | bool | float $value = null,
        private string $description = '',
    ) {
        $this->value = null === $value ? $this->name : $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string | int | bool | float | null
    {
        return $this->value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
