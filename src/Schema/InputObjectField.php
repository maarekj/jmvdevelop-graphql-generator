<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

final class InputObjectField implements WithName, WithType, WithDescription
{
    public function __construct(
        private string $name,
        private string $type,
        private string $description = '',
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
