<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\ObjectField\AbstractObjectFieldGenerator;
use JmvDevelop\GraphqlGenerator\Generator\ObjectField\GetterObjectFieldGenerator;
use JmvDevelop\GraphqlGenerator\Generator\ObjectField\ObjectFieldGenerator;

final class ObjectField extends Field
{
    /**
     * @param list<Argument> $args
     */
    public function __construct(
        string $name,
        string $type,
        array $args = [],
        private ?ObjectFieldGenerator $generator = null,
        string $description = '',
    ) {
        parent::__construct(name: $name, type: $type, args: $args, description: $description);
    }

    public function getGenerator(): ObjectFieldGenerator
    {
        if (null !== $this->generator) {
            return $this->generator;
        }
        if (\count($this->getArgs()) > 0) {
            return new AbstractObjectFieldGenerator();
        }

        return new GetterObjectFieldGenerator();
    }

    public function setGenerator(?ObjectFieldGenerator $generator): self
    {
        $this->generator = $generator;

        return $this;
    }
}
