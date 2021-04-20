<?php

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use function Spatie\Snapshots\assertMatchesSnapshot;

test('test generator', function () {
    $config = require __DIR__.'/../example/graphql-config.php';
    $generator = new JmvDevelop\GraphqlGenerator\Generator($config);
    $fs = new Filesystem(new InMemoryFilesystemAdapter());

    $generator->generate($fs);

    $results = [];
    foreach ($fs->listContents('/', FilesystemOperator::LIST_DEEP) as $content) {
        if ($content->isFile()) {
            $path = $content->path();
            $results[$path] = $fs->read($path);
        }
    }

    assertMatchesSnapshot($results);
});
