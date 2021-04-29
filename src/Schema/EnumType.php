<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\EnumTypeGenerator;
use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

final class EnumType extends TypeDefinition implements OutputType, InputType
{
    private ?TypeGeneratorInterface $generator = null;

    /**
     * @param list<EnumValue> $values
     */
    public function __construct(
        string $name,
        private array $values = [],
        string $description = '',
    ) {
        parent::__construct(name: $name, ns: '', description: $description);
    }

    /**
     * @param list<EnumValue> $values
     */
    public static function create(string $name, array $values = [], string $description = ''): self
    {
        return new self(name: $name, values: $values, description: $description);
    }

    /** @return list<EnumValue> */
    public function getValues(): array
    {
        return $this->values;
    }

    /** @param list<EnumValue> $values */
    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public static function value(string $name, null | string | int | bool | float $value = null, string $description = ''): EnumValue
    {
        return new EnumValue(name: $name, value: $value, description: $description);
    }

    public function getGenerator(): TypeGeneratorInterface
    {
        if (null === $this->generator) {
            $this->generator = new EnumTypeGenerator($this);
        }

        return $this->generator;
    }
}
