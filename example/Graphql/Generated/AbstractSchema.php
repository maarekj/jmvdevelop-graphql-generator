<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated;

use GraphQL\Type\Definition\CustomScalarType;
use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\UnionType;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

abstract class AbstractSchema implements ServiceSubscriberInterface
{
    private $property_scalar_type_DateTimeTz;
    private $property_scalar_type_CompanyId;
    private $property_scalar_type_UserId;
    private $property_scalar_type_CategoryId;
    private $property_enum_type_YesNo;
    private $property_enum_type_OrderDirection;
    private $property_interface_type_WithId;
    private $property_interface_type_WithName;
    private $property_object_type_PagerCompany;
    private $property_object_type_User;
    private $property_object_type_Category;
    private $property_object_type_Company;
    private $property_union_type_CompanyOrCategory;
    private $property_input_object_type_StringExprInput;
    private $property_input_object_type_IntExprInput;
    private $property_input_object_type_SearchCompanyWhereInput;
    private $property_input_object_type_TestInput;
    private $property_input_object_type_CreateUserInput;
    private $property_input_object_type_EditUserInput;
    private $property_input_object_type_TestInputWithStringField;
    private $property_input_object_type_TestWithNullableInputField;

    public function __construct(
        private ContainerInterface $services,
    ) {
    }

    public function get_scalar_ID(): ScalarType
    {
        return \GraphQL\Type\Definition\Type::id();
    }

    public function get_scalar_String(): ScalarType
    {
        return \GraphQL\Type\Definition\Type::string();
    }

    public function get_scalar_Int(): ScalarType
    {
        return \GraphQL\Type\Definition\Type::int();
    }

    public function get_scalar_Float(): ScalarType
    {
        return \GraphQL\Type\Definition\Type::float();
    }

    public function get_scalar_Boolean(): ScalarType
    {
        return \GraphQL\Type\Definition\Type::boolean();
    }

    public function get_scalar_DateTimeTz(): CustomScalarType
    {
        if (null === $this->property_scalar_type_DateTimeTz) {
            $this->property_scalar_type_DateTimeTz = new \GraphQL\Type\Definition\CustomScalarType([
                'description' => 'Represent date with timezone',
                'name' => 'DateTimeTz',
                'serialize' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array|null $variables = null) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType')->parseLiteral($valueNode, $variables);
                },
            ]);
        }

        return $this->property_scalar_type_DateTimeTz;
    }

    public function get_scalar_CompanyId(): CustomScalarType
    {
        if (null === $this->property_scalar_type_CompanyId) {
            $this->property_scalar_type_CompanyId = new \GraphQL\Type\Definition\CustomScalarType([
                'description' => 'Represent an id of Company entity',
                'name' => 'CompanyId',
                'serialize' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array|null $variables = null) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType')->parseLiteral($valueNode, $variables);
                },
            ]);
        }

        return $this->property_scalar_type_CompanyId;
    }

    public function get_scalar_UserId(): CustomScalarType
    {
        if (null === $this->property_scalar_type_UserId) {
            $this->property_scalar_type_UserId = new \GraphQL\Type\Definition\CustomScalarType([
                'description' => 'Represent an id of User entity',
                'name' => 'UserId',
                'serialize' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array|null $variables = null) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType')->parseLiteral($valueNode, $variables);
                },
            ]);
        }

        return $this->property_scalar_type_UserId;
    }

    public function get_scalar_CategoryId(): CustomScalarType
    {
        if (null === $this->property_scalar_type_CategoryId) {
            $this->property_scalar_type_CategoryId = new \GraphQL\Type\Definition\CustomScalarType([
                'description' => 'Represent ad id of Category entity',
                'name' => 'CategoryId',
                'serialize' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array|null $variables = null) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType')->parseLiteral($valueNode, $variables);
                },
            ]);
        }

        return $this->property_scalar_type_CategoryId;
    }

    public function get_enum_type_YesNo(): EnumType
    {
        if (null === $this->property_enum_type_YesNo) {
            $this->property_enum_type_YesNo = new \GraphQL\Type\Definition\EnumType([
                'description' => '',
                'name' => 'YesNo',
                'values' => [
                    'YES' => [
                        'name' => 'YES',
                        'description' => 'Yes value',
                        'value' => 'YES',
                    ],
                    'NO' => [
                        'name' => 'NO',
                        'description' => 'No value',
                        'value' => 'NO',
                    ],
                    'DEFAULT' => [
                        'name' => 'DEFAULT',
                        'description' => 'Default value',
                        'value' => 'DEFAULT',
                    ],
                ],
            ]);
        }

        return $this->property_enum_type_YesNo;
    }

    public function get_enum_type_OrderDirection(): EnumType
    {
        if (null === $this->property_enum_type_OrderDirection) {
            $this->property_enum_type_OrderDirection = new \GraphQL\Type\Definition\EnumType([
                'description' => '',
                'name' => 'OrderDirection',
                'values' => [
                    'ASC' => [
                        'name' => 'ASC',
                        'description' => '',
                        'value' => 'ASC',
                    ],
                    'DESC' => [
                        'name' => 'DESC',
                        'description' => '',
                        'value' => 'DESC',
                    ],
                    'DEFAULT' => [
                        'name' => 'DEFAULT',
                        'description' => '',
                        'value' => 'DEFAULT',
                    ],
                ],
            ]);
        }

        return $this->property_enum_type_OrderDirection;
    }

    public function get_interface_type_WithId(): InterfaceType
    {
        if (null === $this->property_interface_type_WithId) {
            $this->property_interface_type_WithId = new \GraphQL\Type\Definition\InterfaceType([
                'description' => 'Object with id',
                'name' => 'WithId',
                'resolveType' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Interface\WithIdType')->resolveType($value);
                },
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_ID()),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_interface_type_WithId;
    }

    public function get_interface_type_WithName(): InterfaceType
    {
        if (null === $this->property_interface_type_WithName) {
            $this->property_interface_type_WithName = new \GraphQL\Type\Definition\InterfaceType([
                'description' => 'Object with string name',
                'name' => 'WithName',
                'resolveType' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\InterfaceType\WithNameType')->resolveType($value);
                },
                'fields' => function () {
                    return [
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_interface_type_WithName;
    }

    public function get_object_type_PagerCompany(): ObjectType
    {
        if (null === $this->property_object_type_PagerCompany) {
            $this->property_object_type_PagerCompany = new \GraphQL\Type\Definition\ObjectType([
                'description' => 'Pager for company entity',
                'name' => 'PagerCompany',
                'interfaces' => function () {
                    return [
                    ];
                },
                'fields' => function () {
                    return [
                        'currentPage' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Int()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType')->resolveCurrentPage(root: $__root);
                            },
                        ],
                        'maxPerPage' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Int()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType')->resolveMaxPerPage(root: $__root);
                            },
                        ],
                        'nbPages' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Int()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType')->resolveNbPages(root: $__root);
                            },
                        ],
                        'count' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Int()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType')->resolveCount(root: $__root);
                            },
                        ],
                        'results' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Company()))),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType')->resolveResults(root: $__root);
                            },
                        ],
                    ];
                },
            ]);
        }

        return $this->property_object_type_PagerCompany;
    }

    public function get_object_type_User(): ObjectType
    {
        if (null === $this->property_object_type_User) {
            $this->property_object_type_User = new \GraphQL\Type\Definition\ObjectType([
                'description' => 'User entity',
                'name' => 'User',
                'interfaces' => function () {
                    return [
                        $this->get_interface_type_WithId(),
                    ];
                },
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_ID()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType')->resolveId(root: $__root);
                            },
                        ],
                        'email' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType')->resolveEmail(root: $__root);
                            },
                        ],
                        'lastname' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType')->resolveLastname(root: $__root);
                            },
                        ],
                        'firstname' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType')->resolveFirstname(root: $__root);
                            },
                        ],
                    ];
                },
            ]);
        }

        return $this->property_object_type_User;
    }

    public function get_object_type_Category(): ObjectType
    {
        if (null === $this->property_object_type_Category) {
            $this->property_object_type_Category = new \GraphQL\Type\Definition\ObjectType([
                'description' => 'Category entity',
                'name' => 'Category',
                'interfaces' => function () {
                    return [
                        $this->get_interface_type_WithName(),
                        $this->get_interface_type_WithId(),
                    ];
                },
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_ID()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\CategoryType')->resolveId(root: $__root);
                            },
                        ],
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\CategoryType')->resolveName(root: $__root);
                            },
                        ],
                    ];
                },
            ]);
        }

        return $this->property_object_type_Category;
    }

    public function get_object_type_Company(): ObjectType
    {
        if (null === $this->property_object_type_Company) {
            $this->property_object_type_Company = new \GraphQL\Type\Definition\ObjectType([
                'description' => 'Company entity',
                'name' => 'Company',
                'interfaces' => function () {
                    return [
                        $this->get_interface_type_WithName(),
                        $this->get_interface_type_WithId(),
                    ];
                },
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_ID()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType')->resolveId(root: $__root);
                            },
                        ],
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType')->resolveName(root: $__root);
                            },
                        ],
                        'user' => [
                            'type' => $this->get_object_type_User(),
                            'description' => 'The manager of company',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType')->resolveUser(root: $__root);
                            },
                        ],
                        'categories' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Category()))),
                            'description' => 'All categories of company',
                            'args' => [],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType')->resolveCategories(root: $__root);
                            },
                        ],
                        'searchCategories' => [
                            'type' => \GraphQL\Type\Definition\Type::listOf($this->get_object_type_Category()),
                            'description' => 'Search categories of company',
                            'args' => [[
                                'name' => 'name',
                                'description' => '',
                                'type' => $this->get_scalar_String(),
                            ], [
                                'name' => 'keywords',
                                'description' => '',
                                'type' => \GraphQL\Type\Definition\Type::listOf($this->get_scalar_String()),
                            ], [
                                'name' => 'orderBy',
                                'description' => '',
                                'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            ]],
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType')->resolveSearchCategories(root: $__root, name: (null === ($__args['name'] ?? null) ? null : $this->transform_scalar_type_String($__args['name'] ?? null)), keywords: ((function ($__value) {
                                    return null === $__value ? null : array_map(function ($__value) {
                                        return null === ($__value) ? null : $this->transform_scalar_type_String($__value);
                                    }, $__value);
                                })($__args['keywords'] ?? null)), orderBy: ((function ($__value) {
                                    return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_String($__value));
                                })($__args['orderBy'] ?? null)));
                            },
                        ],
                    ];
                },
            ]);
        }

        return $this->property_object_type_Company;
    }

    public function get_union_type_CompanyOrCategory(): UnionType
    {
        if (null === $this->property_union_type_CompanyOrCategory) {
            $this->property_union_type_CompanyOrCategory = new \GraphQL\Type\Definition\UnionType([
                'description' => '',
                'name' => 'CompanyOrCategory',
                'types' => [
                    $this->get_object_type_Company(),
                    $this->get_object_type_Category(),
                ],
                'resolveType' => function ($value) {
                    return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\UnionType\CompanyOrCategoryType')->resolveType($value);
                },
            ]);
        }

        return $this->property_union_type_CompanyOrCategory;
    }

    public function get_input_object_type_StringExprInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_StringExprInput) {
            $this->property_input_object_type_StringExprInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'StringExprInput',
                'fields' => function () {
                    return [
                        'eq' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                        'neq' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                        'like' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_StringExprInput;
    }

    public function get_input_object_type_IntExprInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_IntExprInput) {
            $this->property_input_object_type_IntExprInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'IntExprInput',
                'fields' => function () {
                    return [
                        'eq' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                        'neq' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                        'gt' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                        'gte' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                        'lt' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                        'lte' => [
                            'type' => $this->get_scalar_Int(),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_IntExprInput;
    }

    public function get_input_object_type_SearchCompanyWhereInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_SearchCompanyWhereInput) {
            $this->property_input_object_type_SearchCompanyWhereInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'SearchCompanyWhereInput',
                'fields' => function () {
                    return [
                        '_and' => [
                            'type' => \GraphQL\Type\Definition\Type::listOf($this->get_input_object_type_SearchCompanyWhereInput()),
                            'description' => '',
                        ],
                        '_or' => [
                            'type' => \GraphQL\Type\Definition\Type::listOf($this->get_input_object_type_SearchCompanyWhereInput()),
                            'description' => '',
                        ],
                        'name' => [
                            'type' => $this->get_input_object_type_StringExprInput(),
                            'description' => '',
                        ],
                        'id' => [
                            'type' => $this->get_input_object_type_IntExprInput(),
                            'description' => '',
                        ],
                        'withCategory' => [
                            'type' => $this->get_enum_type_YesNo(),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_SearchCompanyWhereInput;
    }

    public function get_input_object_type_TestInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_TestInput) {
            $this->property_input_object_type_TestInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'TestInput',
                'fields' => function () {
                    return [
                        'enum' => [
                            'type' => $this->get_enum_type_YesNo(),
                            'description' => '',
                        ],
                        'requiredEnum' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_enum_type_YesNo()),
                            'description' => '',
                        ],
                        'listEnum' => [
                            'type' => \GraphQL\Type\Definition\Type::listOf($this->get_enum_type_YesNo()),
                            'description' => '',
                        ],
                        'requiredListEnum' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf($this->get_enum_type_YesNo())),
                            'description' => '',
                        ],
                        'requiredListRequiredEnum' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_enum_type_YesNo()))),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_TestInput;
    }

    public function get_input_object_type_CreateUserInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_CreateUserInput) {
            $this->property_input_object_type_CreateUserInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'CreateUserInput',
                'fields' => function () {
                    return [
                        'email' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                        ],
                        'lastname' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                        'firstname' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_CreateUserInput;
    }

    public function get_input_object_type_EditUserInput(): InputObjectType
    {
        if (null === $this->property_input_object_type_EditUserInput) {
            $this->property_input_object_type_EditUserInput = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'EditUserInput',
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_UserId()),
                            'description' => '',
                        ],
                        'email' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                        ],
                        'lastname' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                        'firstname' => [
                            'type' => $this->get_scalar_String(),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_EditUserInput;
    }

    public function get_input_object_type_TestInputWithStringField(): InputObjectType
    {
        if (null === $this->property_input_object_type_TestInputWithStringField) {
            $this->property_input_object_type_TestInputWithStringField = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'TestInputWithStringField',
                'fields' => function () {
                    return [
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_TestInputWithStringField;
    }

    public function get_input_object_type_TestWithNullableInputField(): InputObjectType
    {
        if (null === $this->property_input_object_type_TestWithNullableInputField) {
            $this->property_input_object_type_TestWithNullableInputField = new \GraphQL\Type\Definition\InputObjectType([
                'description' => '',
                'name' => 'TestWithNullableInputField',
                'fields' => function () {
                    return [
                        'nullableField' => [
                            'type' => $this->get_input_object_type_TestInputWithStringField(),
                            'description' => '',
                        ],
                        'field' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_input_object_type_TestInputWithStringField()),
                            'description' => '',
                        ],
                    ];
                },
            ]);
        }

        return $this->property_input_object_type_TestWithNullableInputField;
    }

    public function query(): ObjectType
    {
        return new \GraphQL\Type\Definition\ObjectType([
            'name' => 'Query',
            'fields' => function () {
                return [
                    'searchByName' => [
                        'name' => 'searchByName',
                        'description' => 'Search all entities with name',
                        'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_interface_type_WithName()))),
                        'args' => [[
                            'name' => 'name',
                            'description' => '',
                            'type' => $this->get_scalar_String(),
                        ], [
                            'name' => 'orderByName',
                            'description' => '',
                            'type' => $this->get_enum_type_OrderDirection(),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\QueryField\SearchByNameField')->resolve(name: (null === ($__args['name'] ?? null) ? null : $this->transform_scalar_type_String($__args['name'] ?? null)), orderByName: (null === ($__args['orderByName'] ?? null) ? null : $this->transform_enum_type_OrderDirection($__args['orderByName'] ?? null)));
                        },
                    ],
                    'searchCompanies' => [
                        'name' => 'searchCompanies',
                        'description' => 'Search companies',
                        'type' => $this->get_object_type_PagerCompany(),
                        'args' => [[
                            'name' => 'where',
                            'description' => '',
                            'type' => $this->get_input_object_type_SearchCompanyWhereInput(),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\SearchCompaniesField')->resolve(where: (null === ($__args['where'] ?? null) ? null : $this->transform_input_object_type_SearchCompanyWhereInput($__args['where'] ?? null)));
                        },
                    ],
                    'company' => [
                        'name' => 'company',
                        'description' => 'Get a company with id',
                        'type' => $this->get_object_type_Company(),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_CompanyId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompanyField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_CompanyId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'strictCompany' => [
                        'name' => 'strictCompany',
                        'description' => 'Get a company with id (strict)',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Company()),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_CompanyId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCompanyField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_CompanyId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'category' => [
                        'name' => 'category',
                        'description' => 'Get a category with id',
                        'type' => $this->get_object_type_Category(),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_CategoryId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CategoryField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_CategoryId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'strictCategory' => [
                        'name' => 'strictCategory',
                        'description' => 'Get a category with id',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Category()),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_CategoryId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCategoryField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_CategoryId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'user' => [
                        'name' => 'user',
                        'description' => 'Get a user with id',
                        'type' => $this->get_object_type_User(),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_UserId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UserField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_UserId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'users' => [
                        'name' => 'users',
                        'description' => 'Get all users',
                        'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_User()))),
                        'args' => [],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UsersField')->resolve();
                        },
                    ],
                    'strictUser' => [
                        'name' => 'strictUser',
                        'description' => 'Get a user with id',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_object_type_User()),
                        'args' => [[
                            'name' => 'id',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_UserId()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictUserField')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_UserId($__value));
                            })($__args['id'] ?? null)));
                        },
                    ],
                    'companiesAndCategories' => [
                        'name' => 'companiesAndCategories',
                        'description' => '',
                        'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_union_type_CompanyOrCategory()))),
                        'args' => [],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompaniesAndCategoriesField')->resolve();
                        },
                    ],
                ];
            },
        ]);
    }

    public function mutation(): ObjectType
    {
        return new \GraphQL\Type\Definition\ObjectType([
            'name' => 'Mutation',
            'fields' => function () {
                return [
                    'createUser' => [
                        'name' => 'createUser',
                        'description' => 'Create an User',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_object_type_User()),
                        'args' => [[
                            'name' => 'data',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_input_object_type_CreateUserInput()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Mutation\CreateUserMutation')->resolve(data: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_input_object_type_CreateUserInput($__value));
                            })($__args['data'] ?? null)));
                        },
                    ],
                    'editUser' => [
                        'name' => 'editUser',
                        'description' => 'Create an User',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_object_type_User()),
                        'args' => [[
                            'name' => 'data',
                            'description' => '',
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_input_object_type_EditUserInput()),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\MutationField\EditUserMutation')->resolve(data: ((function ($__value) {
                                return null === $__value ? null : (null === ($__value) ? null : $this->transform_input_object_type_EditUserInput($__value));
                            })($__args['data'] ?? null)));
                        },
                    ],
                    'testWithNullableInputField' => [
                        'name' => 'testWithNullableInputField',
                        'description' => '',
                        'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Boolean()),
                        'args' => [[
                            'name' => 'data',
                            'description' => '',
                            'type' => $this->get_input_object_type_TestWithNullableInputField(),
                        ]],
                        'resolve' => function ($__root = null, null|array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('JmvDevelop\GraphqlGenerator\Example\Graphql\Test\TestWithNullableInputFieldMutation')->resolve(data: (null === ($__args['data'] ?? null) ? null : $this->transform_input_object_type_TestWithNullableInputField($__args['data'] ?? null)));
                        },
                    ],
                ];
            },
        ]);
    }

    public static function getSubscribedServices(): array
    {
        return [
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Interface\WithIdType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Interface\WithIdType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\InterfaceType\WithNameType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\InterfaceType\WithNameType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\PagerCompanyType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\CategoryType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\CategoryType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\UnionType\CompanyOrCategoryType' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\UnionType\CompanyOrCategoryType',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\QueryField\SearchByNameField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\QueryField\SearchByNameField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\SearchCompaniesField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\SearchCompaniesField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompanyField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompanyField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCompanyField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCompanyField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CategoryField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CategoryField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCategoryField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCategoryField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UserField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UserField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UsersField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UsersField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictUserField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictUserField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompaniesAndCategoriesField' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompaniesAndCategoriesField',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Mutation\CreateUserMutation' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Mutation\CreateUserMutation',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\MutationField\EditUserMutation' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\MutationField\EditUserMutation',
            'JmvDevelop\GraphqlGenerator\Example\Graphql\Test\TestWithNullableInputFieldMutation' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Test\TestWithNullableInputFieldMutation',
        ];
    }

    private function service(string $name)
    {
        return $this->services->get($name);
    }

    private function transform_scalar_type_ID($value)
    {
        return $value;
    }

    private function transform_scalar_type_String($value)
    {
        return $value;
    }

    private function transform_scalar_type_Int($value)
    {
        return $value;
    }

    private function transform_scalar_type_Float($value)
    {
        return $value;
    }

    private function transform_scalar_type_Boolean($value)
    {
        return $value;
    }

    private function transform_scalar_type_DateTimeTz($value)
    {
        return $value;
    }

    private function transform_scalar_type_CompanyId($value)
    {
        return $value;
    }

    private function transform_scalar_type_UserId($value)
    {
        return $value;
    }

    private function transform_scalar_type_CategoryId($value)
    {
        return $value;
    }

    private function transform_enum_type_YesNo($value)
    {
        return $value;
    }

    private function transform_enum_type_OrderDirection($value)
    {
        return $value;
    }

    private function transform_interface_type_WithId($value)
    {
        return $value;
    }

    private function transform_interface_type_WithName($value)
    {
        return $value;
    }

    private function transform_object_type_PagerCompany($value)
    {
        return $value;
    }

    private function transform_object_type_User($value)
    {
        return $value;
    }

    private function transform_object_type_Category($value)
    {
        return $value;
    }

    private function transform_object_type_Company($value)
    {
        return $value;
    }

    private function transform_union_type_CompanyOrCategory($value)
    {
        return $value;
    }

    private function transform_input_object_type_StringExprInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\StringExprInputType(eq: (null === ($value['eq'] ?? null) ? null : $this->transform_scalar_type_String($value['eq'] ?? null)), neq: (null === ($value['neq'] ?? null) ? null : $this->transform_scalar_type_String($value['neq'] ?? null)), like: (null === ($value['like'] ?? null) ? null : $this->transform_scalar_type_String($value['like'] ?? null)));
    }

    private function transform_input_object_type_IntExprInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: (null === ($value['eq'] ?? null) ? null : $this->transform_scalar_type_Int($value['eq'] ?? null)), neq: (null === ($value['neq'] ?? null) ? null : $this->transform_scalar_type_Int($value['neq'] ?? null)), gt: (null === ($value['gt'] ?? null) ? null : $this->transform_scalar_type_Int($value['gt'] ?? null)), gte: (null === ($value['gte'] ?? null) ? null : $this->transform_scalar_type_Int($value['gte'] ?? null)), lt: (null === ($value['lt'] ?? null) ? null : $this->transform_scalar_type_Int($value['lt'] ?? null)), lte: (null === ($value['lte'] ?? null) ? null : $this->transform_scalar_type_Int($value['lte'] ?? null)));
    }

    private function transform_input_object_type_SearchCompanyWhereInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: ((function ($__value) {
            return null === $__value ? null : array_map(function ($__value) {
                return null === ($__value) ? null : $this->transform_input_object_type_SearchCompanyWhereInput($__value);
            }, $__value);
        })($value['_and'] ?? null)), _or: ((function ($__value) {
            return null === $__value ? null : array_map(function ($__value) {
                return null === ($__value) ? null : $this->transform_input_object_type_SearchCompanyWhereInput($__value);
            }, $__value);
        })($value['_or'] ?? null)), name: (null === ($value['name'] ?? null) ? null : $this->transform_input_object_type_StringExprInput($value['name'] ?? null)), id: (null === ($value['id'] ?? null) ? null : $this->transform_input_object_type_IntExprInput($value['id'] ?? null)), withCategory: (null === ($value['withCategory'] ?? null) ? null : $this->transform_enum_type_YesNo($value['withCategory'] ?? null)));
    }

    private function transform_input_object_type_TestInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: (null === ($value['enum'] ?? null) ? null : $this->transform_enum_type_YesNo($value['enum'] ?? null)), requiredEnum: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_enum_type_YesNo($__value));
        })($value['requiredEnum'] ?? null)), listEnum: ((function ($__value) {
            return null === $__value ? null : array_map(function ($__value) {
                return null === ($__value) ? null : $this->transform_enum_type_YesNo($__value);
            }, $__value);
        })($value['listEnum'] ?? null)), requiredListEnum: ((function ($__value) {
            return null === $__value ? null : ((function ($__value) {
                return null === $__value ? null : array_map(function ($__value) {
                    return null === ($__value) ? null : $this->transform_enum_type_YesNo($__value);
                }, $__value);
            })($__value));
        })($value['requiredListEnum'] ?? null)), requiredListRequiredEnum: ((function ($__value) {
            return null === $__value ? null : ((function ($__value) {
                return null === $__value ? null : array_map(function ($__value) {
                    return (function ($__value) {
                        return null === $__value ? null : (null === ($__value) ? null : $this->transform_enum_type_YesNo($__value));
                    })($__value);
                }, $__value);
            })($__value));
        })($value['requiredListRequiredEnum'] ?? null)));
    }

    private function transform_input_object_type_CreateUserInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType(email: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_String($__value));
        })($value['email'] ?? null)), lastname: (null === ($value['lastname'] ?? null) ? null : $this->transform_scalar_type_String($value['lastname'] ?? null)), firstname: (null === ($value['firstname'] ?? null) ? null : $this->transform_scalar_type_String($value['firstname'] ?? null)));
    }

    private function transform_input_object_type_EditUserInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_UserId($__value));
        })($value['id'] ?? null)), email: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_String($__value));
        })($value['email'] ?? null)), lastname: (null === ($value['lastname'] ?? null) ? null : $this->transform_scalar_type_String($value['lastname'] ?? null)), firstname: (null === ($value['firstname'] ?? null) ? null : $this->transform_scalar_type_String($value['firstname'] ?? null)));
    }

    private function transform_input_object_type_TestInputWithStringField($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestInputWithStringFieldType(name: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_scalar_type_String($__value));
        })($value['name'] ?? null)));
    }

    private function transform_input_object_type_TestWithNullableInputField($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Test\TestWithNullableInputFieldType(nullableField: (null === ($value['nullableField'] ?? null) ? null : $this->transform_input_object_type_TestInputWithStringField($value['nullableField'] ?? null)), field: ((function ($__value) {
            return null === $__value ? null : (null === ($__value) ? null : $this->transform_input_object_type_TestInputWithStringField($__value));
        })($value['field'] ?? null)));
    }
}
