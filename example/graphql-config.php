<?php

declare(strict_types=1);

use JmvDevelop\GraphqlGenerator\Example\Entity\Category;
use JmvDevelop\GraphqlGenerator\Example\Entity\Company;
use JmvDevelop\GraphqlGenerator\Example\Entity\Pager;
use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Schema\Argument;
use JmvDevelop\GraphqlGenerator\Schema\EnumType;
use JmvDevelop\GraphqlGenerator\Schema\InputObjectType;
use JmvDevelop\GraphqlGenerator\Schema\InterfaceType;
use JmvDevelop\GraphqlGenerator\Schema\MutationField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use JmvDevelop\GraphqlGenerator\Schema\QueryField;
use JmvDevelop\GraphqlGenerator\Schema\ScalarType;
use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use JmvDevelop\GraphqlGenerator\Schema\SchemaDefinition;
use JmvDevelop\GraphqlGenerator\Schema\UnionType;
use JmvDevelop\GraphqlGenerator\SchemaGenerator\ObjectField\AbstractObjectFieldGenerator;

$abstractGenerator = new AbstractObjectFieldGenerator();

$schema = new SchemaDefinition();

$schema->addType(ScalarType::create(name: 'ID', rootType: 'string|int')->withNativeGenerator('id'));
$schema->addType(ScalarType::create(name: 'String', rootType: 'string')->withNativeGenerator('string'));
$schema->addType(ScalarType::create(name: 'Int', rootType: 'int')->withNativeGenerator('int'));
$schema->addType(ScalarType::create(name: 'Float', rootType: 'float')->withNativeGenerator('float'));
$schema->addType(ScalarType::create(name: 'Boolean', rootType: 'bool')->withNativeGenerator('boolean'));
$schema->addType(ScalarType::create(name: 'DateTimeTz', rootType: '\DateTimeImmutable', ns: 'Custom\\Scalar', description: 'Represent date with timezone'));
$schema->addType(ScalarType::create(name: 'CompanyId', rootType: '\\'.Company::class, description: 'Represent an id of Company entity'));
$schema->addType(ScalarType::create(name: 'UserId', rootType: '\\'.User::class, description: 'Represent an id of User entity'));
$schema->addType(ScalarType::create(name: 'CategoryId', rootType: '\\'.Category::class, description: 'Represent ad id of Category entity'));
$schema->addType(EnumType::create(name: 'YesNo', values: [
    EnumType::value(name: 'YES', value: 'YES', description: 'Yes value'),
    EnumType::value(name: 'NO', value: 'NO', description: 'No value'),
    EnumType::value(name: 'DEFAULT', value: 'DEFAULT', description: 'Default value'),
]));

$schema->addType(EnumType::create(name: 'OrderDirection', values: [
    EnumType::value(name: 'ASC', value: 'ASC'),
    EnumType::value(name: 'DESC', value: 'DESC'),
    EnumType::value(name: 'DEFAULT', value: 'DEFAULT'),
]));

$schema->addType(InterfaceType::create(name: 'WithId', description: 'Object with id', ns: 'Custom\\Interface', fields: [
    InterfaceType::field(name: 'id', type: 'ID!'),
]));
$schema->addType(InterfaceType::create(name: 'WithName', description: 'Object with string name', fields: [
    InterfaceType::field(name: 'name', type: 'String!'),
]));

$schema->addType(ObjectType::create(
    name: 'PagerCompany',
    rootType: '\\'.Pager::class,
    psalmType: '\\'.Pager::class.'<\\'.Company::class.'>',
    description: 'Pager for company entity',
    fields: [
        ObjectType::field(name: 'currentPage', type: 'Int!'),
        ObjectType::field(name: 'maxPerPage', type: 'Int!'),
        ObjectType::field(name: 'nbPages', type: 'Int!'),
        ObjectType::field(name: 'count', type: 'Int!'),
        ObjectType::field(name: 'results', type: '[Company!]!'),
    ]
));

$schema->addType(ObjectType::create(
    name: 'User',
    rootType: '\\'.User::class,
    description: 'User entity',
    interfaces: ['WithId'],
    fields: [
        ObjectType::field(name: 'id', type: 'ID!'),
        ObjectType::field(name: 'email', type: 'String!'),
        ObjectType::field(name: 'lastname', type: 'String!'),
        ObjectType::field(name: 'firstname', type: 'String!'),
    ]
));
$schema->addType(ObjectType::create(
    name: 'Category',
    rootType: '\\'.Category::class,
    description: 'Category entity',
    interfaces: ['WithName', 'WithId'],
    fields: [
        ObjectType::field(name: 'id', type: 'ID!'),
        ObjectType::field(name: 'name', type: 'String!'),
    ]
));
$schema->addType(ObjectType::create(
    name: 'Company',
    rootType: '\\'.Company::class,
    description: 'Company entity',
    interfaces: ['WithName', 'WithId'],
    ns: 'Custom\\Object',
    fields: [
        ObjectType::field(name: 'id', type: 'ID!'),
        ObjectType::field(name: 'name', type: 'String!'),
        ObjectType::field(name: 'user', type: 'User', description: 'The manager of company', generator: $abstractGenerator),
        ObjectType::field(
            name: 'categories',
            type: '[Category!]!',
            description: 'All categories of company',
            generator: $abstractGenerator,
        ),
        ObjectType::field(
            name: 'searchCategories',
            type: '[Category]',
            description: 'Search categories of company',
            generator: $abstractGenerator,
            args: [
                Argument::create(name: 'name', type: 'String'),
                Argument::create(name: 'keywords', type: '[String]'),
                Argument::create(name: 'orderBy', type: 'String!'),
            ]
        ),
    ]
));

$schema->addType(UnionType::create(name: 'CompanyOrCategory', types: [
    'Company', 'Category',
]));

$schema->addType(InputObjectType::create(name: 'StringExprInput', fields: [
    InputObjectType::field(name: 'eq', type: 'String'),
    InputObjectType::field(name: 'neq', type: 'String'),
    InputObjectType::field(name: 'like', type: 'String'),
]));
$schema->addType(InputObjectType::create(name: 'IntExprInput', fields: [
    InputObjectType::field(name: 'eq', type: 'Int'),
    InputObjectType::field(name: 'neq', type: 'Int'),
    InputObjectType::field(name: 'gt', type: 'Int'),
    InputObjectType::field(name: 'gte', type: 'Int'),
    InputObjectType::field(name: 'lt', type: 'Int'),
    InputObjectType::field(name: 'lte', type: 'Int'),
]));
$schema->addType(InputObjectType::create(name: 'SearchCompanyWhereInput', fields: [
    InputObjectType::field(name: '_and', type: '[SearchCompanyWhereInput]'),
    InputObjectType::field(name: '_or', type: '[SearchCompanyWhereInput]'),
    InputObjectType::field(name: 'name', type: 'StringExprInput'),
    InputObjectType::field(name: 'id', type: 'IntExprInput'),
    InputObjectType::field(name: 'withCategory', type: 'YesNo'),
]));

$schema->addQueryField(QueryField::create(
    name: 'searchByName',
    type: '[WithName!]!',
    description: 'Search all entities with name',
    ns: 'Custom\\QueryField',
    args: [
        Argument::create(name: 'name', type: 'String'),
        Argument::create(name: 'orderByName', type: 'OrderDirection'),
    ]
));

$schema->addQueryField(QueryField::create(
    name: 'searchCompanies',
    type: 'PagerCompany',
    description: 'Search companies',
    args: [Argument::create(name: 'where', type: 'SearchCompanyWhereInput')]
));

$schema->addQueryField(QueryField::create(
    name: 'company',
    type: 'Company',
    description: 'Get a company with id',
    args: [Argument::create(name: 'id', type: 'CompanyId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'strictCompany',
    type: 'Company!',
    description: 'Get a company with id (strict)',
    args: [Argument::create(name: 'id', type: 'CompanyId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'category',
    type: 'Category',
    description: 'Get a category with id',
    args: [Argument::create(name: 'id', type: 'CategoryId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'strictCategory',
    type: 'Category!',
    description: 'Get a category with id',
    args: [Argument::create(name: 'id', type: 'CategoryId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'user',
    type: 'User',
    description: 'Get a user with id',
    args: [Argument::create(name: 'id', type: 'UserId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'users',
    type: '[User!]!',
    description: 'Get all users',
    args: [],
));

$schema->addQueryField(QueryField::create(
    name: 'strictUser',
    type: 'User!',
    description: 'Get a user with id',
    args: [Argument::create(name: 'id', type: 'UserId!')],
    autoResolveReturnArg: 'id',
));

$schema->addQueryField(QueryField::create(
    name: 'companiesAndCategories',
    type: '[CompanyOrCategory!]!',
));

$schema->addType(InputObjectType::create(name: 'CreateUserInput', ns: 'Custom\\InputObject', fields: [
    InputObjectType::field(name: 'email', type: 'String!'),
    InputObjectType::field(name: 'lastname', type: 'String'),
    InputObjectType::field(name: 'firstname', type: 'String'),
]));

$schema->addMutationField(MutationField::create(name: 'createUser', ns: 'Custom\\Mutation', description: 'Create an User', type: 'User!', args: [
    Argument::create(name: 'data', type: 'CreateUserInput!'),
]));

$schema->addType(InputObjectType::create(name: 'EditUserInput', fields: [
    InputObjectType::field(name: 'id', type: 'UserId!'),
    InputObjectType::field(name: 'email', type: 'String!'),
    InputObjectType::field(name: 'lastname', type: 'String'),
    InputObjectType::field(name: 'firstname', type: 'String'),
]));

$schema->addMutationField(MutationField::create(name: 'editUser', description: 'Create an User', type: 'User!', args: [
    Argument::create(name: 'data', type: 'EditUserInput!'),
]));

$schema->addType(InputObjectType::create(name: 'TestInputWithStringField', ns: 'Test', fields: [
    InputObjectType::field(name: 'name', type: 'String!'),
]));

$schema->addType(InputObjectType::create(name: 'TestWithNullableInputField', ns: 'Test', fields: [
    InputObjectType::field(name: 'nullableField', type: 'TestInputWithStringField'),
    InputObjectType::field(name: 'field', type: 'TestInputWithStringField!'),
]));

$schema->addMutationField(MutationField::create(name: 'testWithNullableInputField', ns: 'Test', type: 'Boolean!', args: [
    Argument::create(name: 'data', type: 'TestWithNullableInputField'),
]));

return new SchemaConfig(
    out: __DIR__.'/Graphql',
    namespace: 'JmvDevelop\\GraphqlGenerator\\Example\\Graphql',
    schema: $schema
);
