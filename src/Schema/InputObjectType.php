<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\InputObjectTypeGenerator;

final class InputObjectType extends TypeDefinition implements OutputType
{
    private ?InputObjectTypeGenerator $generator = null;

    /**
     * @param list<InputObjectField> $fields
     */
    public function __construct(
        string $name,
        string $ns,
        private array $fields = [],
        string $description = '',
    ) {
        parent::__construct(name: $name, ns: $ns, description: $description);
    }

    /** @param list<InputObjectField> $fields */
    public static function create(
        string $name,
        string $ns = 'InputObjectType',
        array $fields = [],
    ): self {
        return new self(name: $name, ns: $ns, fields: $fields);
    }

    /** @return list<InputObjectField> */
    public function getFields(): array
    {
        return $this->fields;
    }

    /** @param list<InputObjectField> $fields */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function addField(InputObjectField $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    public static function field(string $name, string $type, string $description = ''): InputObjectField
    {
        return new InputObjectField(name: $name, type: $type, description: $description);
    }

    public function getGenerator(): InputObjectTypeGenerator
    {
        if (null === $this->generator) {
            $this->generator = new InputObjectTypeGenerator($this);
        }

        return $this->generator;
    }

    public function withGenerator(InputObjectTypeGenerator $generator): self
    {
        $this->generator = $generator;

        return $this;
    }
}
