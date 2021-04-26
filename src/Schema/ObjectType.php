<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\ObjectField\ObjectFieldGenerator;
use JmvDevelop\GraphqlGenerator\Generator\ObjectTypeGenerator;
use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

final class ObjectType extends TypeDefinition implements OutputType
{
    private ?TypeGeneratorInterface $generator = null;

    /**
     * @param list<ObjectField> $fields
     * @param list<string>      $interfaces
     */
    public function __construct(
        string $name,
        private string $rootType,
        string $ns,
        private array $fields = [],
        private array $interfaces = [],
        string $description = '',
    ) {
        $this->rootType = '\\'.\ltrim($this->rootType, '\\');
        parent::__construct(name: $name, ns: $ns, description: $description);
    }

    /**
     * @param list<ObjectField> $fields
     * @param list<string>      $interfaces
     */
    public static function create(
        string $name,
        string $rootType,
        string $ns = 'ObjectType',
        array $interfaces = [],
        string $description = '',
        array $fields = [],
    ): self {
        return new self(name: $name, rootType: $rootType, ns: $ns, fields: $fields, interfaces: $interfaces, description: $description);
    }

    /** @param list<Argument> $args */
    public static function field(string $name, string $type, array $args = [], ?ObjectFieldGenerator $generator = null, string $description = ''): ObjectField
    {
        return new ObjectField(name: $name, type: $type, args: $args, generator: $generator, description: $description);
    }

    public function getRootType(): string
    {
        return $this->rootType;
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

    /** @return list<string> */
    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    /** @param list<string> $interfaces */
    public function setInterfaces(array $interfaces): self
    {
        $this->interfaces = $interfaces;

        return $this;
    }

    public function addInterface(string $interface): self
    {
        $this->interfaces[] = $interface;

        return $this;
    }

    public function getGenerator(): TypeGeneratorInterface
    {
        if (null === $this->generator) {
            $this->generator = new ObjectTypeGenerator($this);
        }

        return $this->generator;
    }

    public function withGenerator(TypeGeneratorInterface $generator): self
    {
        $this->generator = $generator;

        return $this;
    }
}
