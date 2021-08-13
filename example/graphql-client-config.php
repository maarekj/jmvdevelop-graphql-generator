<?php

declare(strict_types=1);

use JmvDevelop\GraphqlGenerator\ClientGenerator\Config;
use JmvDevelop\GraphqlGenerator\ClientGenerator\CustomScalarConfig;
use JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder\SymfonyQueryFinder;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Finder\Finder;

return new Config(
    out: __DIR__.'/Graphql',
    namespace: 'JmvDevelop\\GraphqlGenerator\\Example\\Graphql',
    schema: (new Schema(new Container()))->schema(),
    queryFinder: new SymfonyQueryFinder(Finder::create()->in(__DIR__.'/../tests/queries')->name('*.graphql')->files()),
    scalars: [
        new CustomScalarConfig(name: 'UserId', php: 'int'),
        new CustomScalarConfig(name: 'CompanyId', php: 'int'),
        new CustomScalarConfig(name: 'CategoryId', php: 'int'),
    ],
);
