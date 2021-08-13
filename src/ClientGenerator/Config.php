<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

use GraphQL\Type\Schema;
use JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder\QueryFinder;
use Webmozart\Assert\Assert;

final class Config
{
    /**
     * @param list<ScalarConfig> $scalars
     */
    public function __construct(
        private string $out,
        private string $namespace,
        private QueryFinder $queryFinder,
        private Schema $schema,
        private array $scalars = [],
    ) {
        $this->scalars = \array_merge([], [
            new IdScalarConfig(name: 'String', php: 'string'),
            new IdScalarConfig(name: 'Int', php: 'int'),
            new IdScalarConfig(name: 'ID', php: 'string'),
            new IdScalarConfig(name: 'Boolean', php: 'bool'),
            new IdScalarConfig(name: 'Float', php: 'float'),
            new CustomScalarConfig(name: 'DateTimeTz', php: '\\'.\DateTimeImmutable::class, psalm: '\\'.\DateTimeImmutable::class),
        ], $this->scalars);
    }

    public function getOut(): string
    {
        return $this->out;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getQueryFinder(): QueryFinder
    {
        return $this->queryFinder;
    }

    public function getSchema(): Schema
    {
        return $this->schema;
    }

    public function getScalarConfig(string $name): ?ScalarConfig
    {
        foreach ($this->scalars as $scalar) {
            if ($scalar->name() === $name) {
                return $scalar;
            }
        }

        return null;
    }

    public function getScalarConfigOrThrow(string $name): ScalarConfig
    {
        $scalar = $this->getScalarConfig($name);
        Assert::notNull($scalar, 'Scalar '.$name.' not found');

        return $scalar;
    }
}
