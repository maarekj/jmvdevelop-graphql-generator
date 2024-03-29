<?php

declare(strict_types=1);

use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\CategoryRepo;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\CompanyRepo;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Schema;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use function PHPUnit\Framework\assertNull;
use function Spatie\Snapshots\assertMatchesJsonSnapshot;

$container = null;

$assertMatchExecuteGraphqlSnapshot = function ($query, array $variables = []) use (&$container): void {
    $result = GraphQL::executeQuery(
        schema: $container->get(Schema::class)->schema(),
        source: $query,
        variableValues: $variables,
    );
    assertMatchesJsonSnapshot(json_encode($result->toArray(DebugFlag::INCLUDE_TRACE | DebugFlag::INCLUDE_DEBUG_MESSAGE)));
};

beforeEach(function () use (&$container): void {
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
});

test('schema is validate', function () use (&$container): void {
    $schema = $container->get(Schema::class)->schema();
    assertNull($schema->assertValid());
});

test('company query', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query Company1And2Query {
            jmv1: company(id: 1) {
                ...Company
            }
            jmv2: company(id: 2) {
                ...Company
            }
        }

        fragment Company on Company {
            id name
            categories {
                id name
            }
        }
        '
    );
});

test('searchCompanies with no arg', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query SearchCompanies {
            searchCompanies {
                currentPage nbPages count maxPerPage
                results { id name }
            }
        }
        '
    );
});

test('searchCompanies with id', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot('query SearchCompanies {
            searchCompanies(where: {id: {eq: 1}}) {
                currentPage nbPages count maxPerPage
                results { id name }
            }
        }
        ');
});

test('searchCompanies with id neq', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query SearchCompanies {
            searchCompanies(where: {id: {neq: 1}}) {
                currentPage nbPages count maxPerPage
                results { id name }
            }
        }
        '
    );
});

test('user', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query UserQuery {
            users {
                id lastname firstname email
            }
        }
        '
    );

    $assertMatchExecuteGraphqlSnapshot(
        '
        mutation UserMutation {
            createUser(data: {lastname: "Maarek", firstname: "Joseph", email: "josephmaarek@gmail . com"}) {
                id lastname firstname email
            }
        }'
    );

    $assertMatchExecuteGraphqlSnapshot(
        '
        mutation UserMutation {
            createUser(data: {lastname: "Maarek", firstname: "Vanessa", email: "vanessamaarek@gmail . com"}) {
                id lastname firstname email
            }
        }'
    );

    $assertMatchExecuteGraphqlSnapshot(
        '
        mutation UserMutation {
            editUser(data: {id: 2, lastname: "Doe", firstname: "Jane", email: "vanessamaarek@gmail . com"}) {
                id lastname firstname email
            }
        }'
    );

    $assertMatchExecuteGraphqlSnapshot(
        '
        query UserQuery {
            users {
                id lastname firstname email
            }
        }'
    );
});

test('test searchByName (with interface)', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query SearchByName {
            searchByName {
                name
                __typename
                ... on Category {
                    id
                }
                ... on Company {
                    id
                    categories { id name }
                }
            }
        }
        '
    );

    $assertMatchExecuteGraphqlSnapshot(
        'query SearchByName {
            searchByName(orderByName: DESC) {
                name
                __typename
                ... on Category {
                    id
                }
                ... on Company {
                    id
                    categories { id name }
                }
            }
        }
        '
    );

    $assertMatchExecuteGraphqlSnapshot(
        'query SearchByName {
            searchByName(orderByName: ASC) {
                name
                __typename
                ... on Category {
                    id
                }
                ... on Company {
                    id
                    categories { id name }
                }
            }
        }
        '
    );
});

test('test company > searchCategory (argument in object field)', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query CompanySearchCategory {
            company(id: 1) {
                id
                name
                searchCategories(name: "name", orderBy: "id") {
                    id
                    name
                }
            }
        }
        '
    );
});

test('test companiesAndCategories (union)', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'query CompaniesAndCategories {
            companiesAndCategories {
                ... on Company {
                    id name
                    __typename
                }
                ... on Category {
                    id name
                    __typename
                }
            }
        }
        '
    );
});

test('test with nullable input field', function () use ($assertMatchExecuteGraphqlSnapshot): void {
    $assertMatchExecuteGraphqlSnapshot(
        'mutation TestWithNullableInputFieldMutation($data: TestWithNullableInputField) {
            testWithNullableInputField(data: $data)
        }
        ',
        [
            'data' => [
                'field' => ['name' => 'test'],
                'nullableField' => null,
            ],
        ]
    );
});
