<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

abstract class Field implements WithName, WithDescription, WithType
{
    /**
     * @param list<Argument> $args
     */
    public function __construct(
        private string $name,
        private string $type,
        private array $args = [],
        private string $description = '',
    ) {
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

    /** @return list<Argument> */
    public function getArgs(): array
    {
        return $this->args;
    }

    /** @param list<Argument> $args */
    public function setArgs(array $args): self
    {
        $this->args = $args;

        return $this;
    }

    public function addArg(Argument $arg): self
    {
        $this->args[] = $arg;

        return $this;
    }
}
