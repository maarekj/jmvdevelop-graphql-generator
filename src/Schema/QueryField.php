<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

final class QueryField extends Field implements WithSuffixNamespace
{
    /**
     * @param list<Argument> $args
     */
    public function __construct(
        string $name,
        string $type,
        private string $ns,
        array $args = [],
        string $description = '',
        private ?string $autoResolveReturnArg = null,
    ) {
        parent::__construct(name: $name, type: $type, args: $args, description: $description);
    }

    /** @param list<Argument> $args */
    public static function create(string $name, string $type, string $ns = 'QueryField', array $args = [], string $description = '', ?string $autoResolveReturnArg = null): self
    {
        return new self(name: $name, type: $type, ns: $ns, args: $args, description: $description, autoResolveReturnArg: $autoResolveReturnArg);
    }

    public function getAutoResolveReturnArg(): ?string
    {
        return $this->autoResolveReturnArg;
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
}
