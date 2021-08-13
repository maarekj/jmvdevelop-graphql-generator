<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

final class SchemaConfig
{
    public function __construct(
        private string $out,
        private string $namespace,
        private SchemaDefinition $schema,
    ) {
    }

    public function getOut(): string
    {
        return $this->out;
    }

    public function setOut(string $out): self
    {
        $this->out = $out;

        return $this;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getSchema(): SchemaDefinition
    {
        return $this->schema;
    }

    public function setSchema(SchemaDefinition $schema): self
    {
        $this->schema = $schema;

        return $this;
    }
}
