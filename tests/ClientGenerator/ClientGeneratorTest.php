<?php

declare(strict_types=1);

use GraphQL\Utils\BuildSchema;
use JmvDevelop\GraphqlGenerator\ClientGenerator\Config;
use JmvDevelop\GraphqlGenerator\ClientGenerator\CustomScalarConfig;
use JmvDevelop\GraphqlGenerator\ClientGenerator\IdScalarConfig;
use JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder\SymfonyQueryFinder;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use Symfony\Component\Finder\Finder;
use function Spatie\Snapshots\assertMatchesSnapshot;

test('generateClient', function (): void {
    $finder = Finder::create()->in(__DIR__.'/queries')->files()->name('*.graphql');
    $schema = BuildSchema::build(file_get_contents(__DIR__.'/schema.graphql'));

    $config = new Config(
        out: __DIR__.'/Graphql',
        namespace: 'JmvDevelop\\GraphqlGenerator\\Example\\Graphql',
        queryFinder: new SymfonyQueryFinder($finder),
        schema: $schema,
        scalars: [
            new IdScalarConfig(name: 'ID', php: 'int|string'),
            new IdScalarConfig(name: 'String', php: 'string'),
            new IdScalarConfig(name: 'Int', php: 'int'),
            new IdScalarConfig(name: 'Float', php: 'float'),
            new IdScalarConfig(name: 'Boolean', php: 'bool'),
            new CustomScalarConfig(
                name: 'DateTimeTz',
                php: '\DateTimeImmutable',
                psalm: '\DateTimeImmutable',
            ),
        ],
    );

    $generator = new JmvDevelop\GraphqlGenerator\ClientGenerator\ClientGenerator($config);
    $fs = new Filesystem(new InMemoryFilesystemAdapter());

    $generator->generateClient($fs);

    $results = [];
    foreach ($fs->listContents('/', FilesystemOperator::LIST_DEEP) as $content) {
        if ($content->isFile()) {
            $path = $content->path();
            $results[$path] = $fs->read($path);
        }
    }

    assertMatchesSnapshot($results);
});
