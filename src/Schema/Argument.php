<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

final class Argument implements WithName, WithDescription, WithType
{
    public function __construct(
        private string $name,
        private string $type,
        private string $description = '',
    ) {
    }

    public static function create(string $name, string $type, string $description = ''): self
    {
        return new Argument(name: $name, type: $type, description: $description);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
