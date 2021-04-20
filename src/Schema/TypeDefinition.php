<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

abstract class TypeDefinition implements WithName, WithDescription, WithTypeGenerator, WithSuffixNamespace
{
    public function __construct(
        private string $name,
        private string $ns,
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

    public function getSuffixNamespace(): string
    {
        return $this->ns;
    }

    public function setSuffixNamespace(string $ns): self
    {
        $this->ns = $ns;

        return $this;
    }

    abstract public function getGenerator(): TypeGeneratorInterface;
}
