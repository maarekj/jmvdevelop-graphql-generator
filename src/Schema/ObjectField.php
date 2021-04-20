<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

final class ObjectField extends Field
{
    /**
     * @param list<Argument> $args
     */
    public function __construct(
        string $name,
        string $type,
        array $args = [],
        private bool $autoGetter = true,
        string $description = '',
    ) {
        parent::__construct(name: $name, type: $type, args: $args, description: $description);
        $this->normalizeAutoGetter();
    }

    public function hasAutoGetter(): bool
    {
        return $this->autoGetter;
    }

    /** @param list<Argument> $args */
    public function setArgs(array $args): self
    {
        parent::setArgs($args);
        $this->normalizeAutoGetter();

        return $this;
    }

    public function addArg(Argument $arg): self
    {
        parent::addArg($arg);
        $this->normalizeAutoGetter();

        return $this;
    }

    private function normalizeAutoGetter(): void
    {
        $this->autoGetter = \count($this->getArgs()) > 0 ? false : $this->autoGetter;
    }
}
