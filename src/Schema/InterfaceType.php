<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\InterfaceTypeGenerator;
use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

final class InterfaceType extends TypeDefinition implements OutputType
{
    private ?TypeGeneratorInterface $generator = null;

    /** @param list<ObjectField> $fields */
    public function __construct(
        string $name,
        string $ns,
        private array $fields = [],
        string $description = '',
    ) {
        parent::__construct(name: $name, ns: $ns, description: $description);
    }

    /** @param list<ObjectField> $fields */
    public static function create(
        string $name,
        string $ns = 'InterfaceType',
        string $description = '',
        array $fields = [],
    ): self {
        return new self(name: $name, fields: $fields, ns: $ns, description: $description);
    }

    /** @param list<Argument> $args */
    public static function field(string $name, string $type, array $args = [], string $description = ''): ObjectField
    {
        return new ObjectField(name: $name, type: $type, args: $args, description: $description);
    }

    /** @return list<ObjectField> */
    public function getFields(): array
    {
        return $this->fields;
    }

    /** @param list<ObjectField> $fields */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function addField(ObjectField $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    public function getGenerator(): TypeGeneratorInterface
    {
        if (null === $this->generator) {
            $this->generator = new InterfaceTypeGenerator($this);
        }

        return $this->generator;
    }

    public function withGenerator(TypeGeneratorInterface $generator): self
    {
        $this->generator = $generator;

        return $this;
    }
}
