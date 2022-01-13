<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use GraphQL\Language\Source;
use function Psl\Type\object;
use function Psl\Type\vec;
use Symfony\Component\Finder\Finder;

final class GQLQueryFinder implements QueryFinder
{
    public function __construct(
        private Finder $finderPhpFiles,
        private string $prefixNs,
    ) {
    }

    /**
     * @throws \ReflectionException
     *
     * @return iterable<Source|string>
     */
    public function findQueries(): iterable
    {
        $phpFiles = $this->findPhpFiles();
        foreach ($phpFiles as $file) {
            try {
                /** @psalm-suppress UnresolvableInclude */
                require_once $file;
            } catch (\Throwable $t) {
            }
        }

        $classes = array_values(array_filter(get_declared_classes(), fn ($class): bool => str_starts_with($class, $this->prefixNs)));
        foreach ($classes as $class) {
            $reflection = new \ReflectionClass($class);
            yield from $this->findQueriesOnClass($reflection);
        }
    }

    /** @return iterable<Source|string> */
    private function findQueriesOnClass(\ReflectionClass $reflection): iterable
    {
        $attributes = $reflection->getAttributes(GQL::class);
        yield from $this->findQueriesOnAttributes($attributes);

        foreach ($reflection->getReflectionConstants() as $constant) {
            yield from $this->findQueriesOnClassConstant($constant);
        }

        foreach ($reflection->getMethods() as $method) {
            yield from $this->findQueriesOnMethod($method);
        }

        foreach ($reflection->getProperties() as $property) {
            yield from $this->findQueriesOnProperty($property);
        }
    }

    /** @return iterable<Source|string> */
    private function findQueriesOnClassConstant(\ReflectionClassConstant $constant): iterable
    {
        $attributes = $constant->getAttributes(GQL::class);
        yield from $this->findQueriesOnAttributes($attributes);
    }

    /** @return iterable<Source|string> */
    private function findQueriesOnMethod(\ReflectionMethod $method): iterable
    {
        $attributes = $method->getAttributes(GQL::class);
        yield from $this->findQueriesOnAttributes($attributes);
    }

    /** @return iterable<Source|string> */
    private function findQueriesOnProperty(\ReflectionProperty $property): iterable
    {
        $attributes = $property->getAttributes(GQL::class);
        yield from $this->findQueriesOnAttributes($attributes);
    }

    /**
     * @param \ReflectionAttribute<GQL>[] $attributes
     *
     * @return iterable<Source|string>
     */
    private function findQueriesOnAttributes(array $attributes): iterable
    {
        foreach ($attributes as $attribute) {
            $gql = $attribute->newInstance();
            yield $gql->query;
        }
    }

    /**
     * @throws \Exception
     *
     * @return list<string>
     */
    private function findPhpFiles(): array
    {
        $res = [];
        $files = vec(object(\SplFileInfo::class))
            ->coerce($this->finderPhpFiles->getIterator())
        ;

        foreach ($files as $file) {
            $path = $file->getRealPath();
            if (false !== $path) {
                $res[] = $file->getPathname();
            }
        }

        return $res;
    }
}
