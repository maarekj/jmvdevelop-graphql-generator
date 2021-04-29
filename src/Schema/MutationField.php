<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

final class MutationField extends Field implements WithSuffixNamespace
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
    ) {
        parent::__construct(name: $name, type: $type, args: $args, description: $description);
    }

    /** @param list<Argument> $args */
    public static function create(string $name, string $type, array $args = [], string $ns = 'MutationField', string $description = ''): self
    {
        return new self(name: $name, type: $type, ns: $ns, args: $args, description: $description);
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
