<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;
use JmvDevelop\GraphqlGenerator\Generator\UnionTypeGenerator;

final class UnionType extends TypeDefinition implements OutputType
{
    private ?TypeGeneratorInterface $generator = null;

    /** @param list<string> $types */
    public function __construct(
        string $name,
        string $ns,
        private array $types = [],
        string $description = '',
    ) {
        parent::__construct(name: $name, ns: $ns, description: $description);
    }

    /** @param list<string> $types */
    public static function create(
        string $name,
        string $ns = 'UnionType',
        string $description = '',
        array $types = [],
    ): self {
        return new self(name: $name, types: $types, ns: $ns, description: $description);
    }

    public function getGenerator(): TypeGeneratorInterface
    {
        if (null === $this->generator) {
            $this->generator = new UnionTypeGenerator($this);
        }

        return $this->generator;
    }

    public function withGenerator(TypeGeneratorInterface $generator): self
    {
        $this->generator = $generator;

        return $this;
    }

    /** @return string[] */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param list<string> $types */
    public function setTypes(array $types): self
    {
        $this->types = $types;

        return $this;
    }

    public function addType(string $type): self
    {
        $this->types[] = $type;

        return $this;
    }
}
