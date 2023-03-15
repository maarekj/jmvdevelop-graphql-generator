<?php

declare(strict_types=1);

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Client;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\IntExprInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use function Spatie\Snapshots\assertMatchesJsonSnapshot;

/** @var \Psr\Container\ContainerInterface $container */
$container = null;

/** @var Client $client */
$client = null;

beforeEach(function () use (&$container, &$client): void {
    $container = new ContainerBuilder();
    $loader = new PhpFileLoader($container, new FileLocator(__DIR__));
    $loader->load(__DIR__.'/services/schema.php');

    $container->compile();
    $companyRepo = $container->get(CompanyRepo::class);
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'A JMV 1', categories: []));
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'B JMV 2', categories: []));
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'C JMV 3', categories: []));
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'D JMV 4', categories: []));
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'E JMV 5', categories: []));
    $companyRepo->add(new Company(id: $companyRepo->nextId(), name: 'F JMV 6', categories: []));

    $categoryRepo = $container->get(CategoryRepo::class);
    $categoryRepo->add(new Category(id: $categoryRepo->nextId(), name: 'A Catégorie 1'));
    $categoryRepo->add(new Category(id: $categoryRepo->nextId(), name: 'B Catégorie 2'));
    $categoryRepo->add(new Category(id: $categoryRepo->nextId(), name: 'C Catégorie 3'));
    $categoryRepo->add(new Category(id: $categoryRepo->nextId(), name: 'D Catégorie 4'));
    $categoryRepo->add(new Category(id: $categoryRepo->nextId(), name: 'E Catégorie 5'));

    $client = $container->get(Client::class);
});

test('company1And2Query', function () use (&$client): void {
    $data = $client->execute_company1And2Query();
    assertMatchesJsonSnapshot(json_encode($data));
});

test('searchCompaniesWithNoArg', function () use (&$client): void {
    $data = $client->execute_searchCompaniesWithNoArg();
    assertMatchesJsonSnapshot(json_encode($data));
});

test('searchCompaniesWithId', function () use (&$client): void {
    $data = $client->execute_searchCompaniesWithId(id: 1);
    assertMatchesJsonSnapshot(json_encode($data));
});

test('searchCompanies', function () use (&$client): void {
    $data = $client->execute_searchCompanies(where: null);
    assertMatchesJsonSnapshot(json_encode($data));

    $data = $client->execute_searchCompanies(where: new SearchCompanyWhereInput());
    assertMatchesJsonSnapshot(json_encode($data));

    $data = $client->execute_searchCompanies(where: new SearchCompanyWhereInput(id: new IntExprInput(eq: 1)));
    assertMatchesJsonSnapshot(json_encode($data));
});
