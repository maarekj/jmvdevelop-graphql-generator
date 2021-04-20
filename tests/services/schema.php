<?php

use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\UserRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {
    $services = $configurator
        ->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->set(Schema::class)
        ->public()
        ->tag('container.service_subscriber')
    ;

    $services->set(CategoryRepo::class)->public();
    $services->set(CompanyRepo::class)->public();
    $services->set(UserRepo::class)->public();
    $services->load(
        'JmvDevelop\\GraphqlGenerator\\Example\\Graphql\\',
        __DIR__.'/../../example/Graphql/*',
    )->exclude([
        __DIR__.'/../../example/Graphql/Generated',
        __DIR__.'/../../example/Graphql/Schema.php',
    ]);
};
