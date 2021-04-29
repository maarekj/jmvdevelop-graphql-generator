<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\NativeScalarTypeGenerator;
use JmvDevelop\GraphqlGenerator\Generator\ScalarTypeGenerator;
use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

final class ScalarType extends TypeDefinition implements OutputType, InputType
{
    private ?TypeGeneratorInterface $generator = null;

    public function __construct(
        string $name,
        private string $rootType,
        string $ns,
        string $description = '',
    ) {
        parent::__construct(name: $name, ns: $ns, description: $description);
    }

    public static function create(string $name, string $rootType, string $ns = 'ScalarType', string $description = ''): self
    {
        return new self(name: $name, rootType: $rootType, ns: $ns, description: $description);
    }

    public function getRootType(): string
    {
        return $this->rootType;
    }

    public function getGenerator(): TypeGeneratorInterface
    {
        if (null === $this->generator) {
            $this->generator = new ScalarTypeGenerator($this);
        }

        return $this->generator;
    }

    public function withNativeGenerator(string $nativeType): self
    {
        $this->generator = new NativeScalarTypeGenerator(nativeType: $nativeType, type: $this);

        return $this;
    }
}
