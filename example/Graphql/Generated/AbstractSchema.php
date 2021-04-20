<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated;

use GraphQL\Type\Definition\CustomScalarType;
use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ScalarType;
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
    private $property_object_type_User;
    private $property_object_type_Category;
    private $property_object_type_Company;
    private $property_input_object_type_StringExprInput;
    private $property_input_object_type_IntExprInput;
    private $property_input_object_type_SearchCompanyWhereInput;
    private $property_input_object_type_CreateUserInput;
    private $property_input_object_type_EditUserInput;

    public function __construct(private ContainerInterface $services)
    {
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
                    return $this->service('type.DateTimeTz')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('type.DateTimeTz')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array | null $variables = null) {
                    return $this->service('type.DateTimeTz')->parseLiteral($valueNode, $variables);
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
                    return $this->service('type.CompanyId')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('type.CompanyId')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array | null $variables = null) {
                    return $this->service('type.CompanyId')->parseLiteral($valueNode, $variables);
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
                    return $this->service('type.UserId')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('type.UserId')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array | null $variables = null) {
                    return $this->service('type.UserId')->parseLiteral($valueNode, $variables);
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
                    return $this->service('type.CategoryId')->serialize($value);
                },
                'parseValue' => function ($value) {
                    return $this->service('type.CategoryId')->parseValue($value);
                },
                'parseLiteral' => function (\GraphQL\Language\AST\Node $valueNode, array | null $variables = null) {
                    return $this->service('type.CategoryId')->parseLiteral($valueNode, $variables);
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
                    return $this->service('type.WithId')->resolveType($value);
                },
                'fields' => function () {
                    return [
                        'id' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_Int()),
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
                    return $this->service('type.WithName')->resolveType($value);
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
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.User')->resolveId(root: $__root, );
                            },
                        ],
                        'email' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.User')->resolveEmail(root: $__root, );
                            },
                        ],
                        'lastname' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.User')->resolveLastname(root: $__root, );
                            },
                        ],
                        'firstname' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.User')->resolveFirstname(root: $__root, );
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
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Category')->resolveId(root: $__root, );
                            },
                        ],
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Category')->resolveName(root: $__root, );
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
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Company')->resolveId(root: $__root, );
                            },
                        ],
                        'name' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull($this->get_scalar_String()),
                            'description' => '',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Company')->resolveName(root: $__root, );
                            },
                        ],
                        'user' => [
                            'type' => $this->get_object_type_User(),
                            'description' => 'The manager of company',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Company')->resolveUser(root: $__root, );
                            },
                        ],
                        'categories' => [
                            'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Category()))),
                            'description' => 'All categories of company',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Company')->resolveCategories(root: $__root, );
                            },
                        ],
                        'searchCategories' => [
                            'type' => \GraphQL\Type\Definition\Type::listOf($this->get_object_type_Category()),
                            'description' => 'Search categories of company',
                            'resolve' => function ($__root, array $__args = []) {
                                return $this->service('type.Company')->resolveSearchCategories(root: $__root, name: ($this->transform_scalar_type_String(($__args)['name'] ?? null)), keywords: ((function ($__value) {
                                    return null === $__value ? null : \array_map(function ($__value) {
                                        return $this->transform_scalar_type_String($__value);
                                    }, $__value);
                                })(($__args)['keywords'] ?? null)), orderBy: ((function ($__value) {
                                    return null === $__value ? null : ($this->transform_scalar_type_String($__value));
                                })(($__args)['orderBy'] ?? null)));
                            },
                        ],
                    ];
                },
            ]);
        }

        return $this->property_object_type_Company;
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.searchByName')->resolve(name: ($this->transform_scalar_type_String(($__args)['name'] ?? null)), orderByName: ($this->transform_enum_type_OrderDirection(($__args)['orderByName'] ?? null)));
                        },
                    ],
                    'searchCompanies' => [
                        'name' => 'searchCompanies',
                        'description' => 'Search companies',
                        'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_Company()))),
                        'args' => [[
                            'name' => 'where',
                            'description' => '',
                            'type' => $this->get_input_object_type_SearchCompanyWhereInput(),
                        ]],
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.searchCompanies')->resolve(where: ($this->transform_input_object_type_SearchCompanyWhereInput(($__args)['where'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.company')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_CompanyId($__value));
                            })(($__args)['id'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.strictCompany')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_CompanyId($__value));
                            })(($__args)['id'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.category')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_CategoryId($__value));
                            })(($__args)['id'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.strictCategory')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_CategoryId($__value));
                            })(($__args)['id'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.user')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_UserId($__value));
                            })(($__args)['id'] ?? null)));
                        },
                    ],
                    'users' => [
                        'name' => 'users',
                        'description' => 'Get all users',
                        'type' => \GraphQL\Type\Definition\Type::nonNull(\GraphQL\Type\Definition\Type::listOf(\GraphQL\Type\Definition\Type::nonNull($this->get_object_type_User()))),
                        'args' => [],
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.users')->resolve();
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('query_field.strictUser')->resolve(id: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_scalar_type_UserId($__value));
                            })(($__args)['id'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('mutation_field.createUser')->resolve(data: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_input_object_type_CreateUserInput($__value));
                            })(($__args)['data'] ?? null)));
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
                        'resolve' => function ($__root = null, null | array $__args = null) {
                            $__args = null === $__args ? [] : $__args;

                            return $this->service('mutation_field.editUser')->resolve(data: ((function ($__value) {
                                return null === $__value ? null : ($this->transform_input_object_type_EditUserInput($__value));
                            })(($__args)['data'] ?? null)));
                        },
                    ],
                ];
            },
        ]);
    }

    public static function getSubscribedServices(): array
    {
        return [
            'type.DateTimeTz' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar\DateTimeTzType',
            'type.CompanyId' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CompanyIdType',
            'type.UserId' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\UserIdType',
            'type.CategoryId' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ScalarType\CategoryIdType',
            'type.WithId' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Interface\WithIdType',
            'type.WithName' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\InterfaceType\WithNameType',
            'type.User' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\UserType',
            'type.Category' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\ObjectType\CategoryType',
            'type.Company' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Object\CompanyType',
            'query_field.searchByName' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\QueryField\SearchByNameField',
            'query_field.searchCompanies' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\SearchCompaniesField',
            'query_field.company' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CompanyField',
            'query_field.strictCompany' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCompanyField',
            'query_field.category' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\CategoryField',
            'query_field.strictCategory' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictCategoryField',
            'query_field.user' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UserField',
            'query_field.users' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\UsersField',
            'query_field.strictUser' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\QueryField\StrictUserField',
            'mutation_field.createUser' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Mutation\CreateUserMutation',
            'mutation_field.editUser' => 'JmvDevelop\GraphqlGenerator\Example\Graphql\MutationField\EditUserMutation',
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

    private function transform_input_object_type_StringExprInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\StringExprInputType(eq: ($this->transform_scalar_type_String(($value)['eq'] ?? null)), neq: ($this->transform_scalar_type_String(($value)['neq'] ?? null)), like: ($this->transform_scalar_type_String(($value)['like'] ?? null)));
    }

    private function transform_input_object_type_IntExprInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\IntExprInputType(eq: ($this->transform_scalar_type_Int(($value)['eq'] ?? null)), neq: ($this->transform_scalar_type_Int(($value)['neq'] ?? null)), gt: ($this->transform_scalar_type_Int(($value)['gt'] ?? null)), gte: ($this->transform_scalar_type_Int(($value)['gte'] ?? null)), lt: ($this->transform_scalar_type_Int(($value)['lt'] ?? null)), lte: ($this->transform_scalar_type_Int(($value)['lte'] ?? null)));
    }

    private function transform_input_object_type_SearchCompanyWhereInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\SearchCompanyWhereInputType(_and: ((function ($__value) {
            return null === $__value ? null : \array_map(function ($__value) {
                return $this->transform_input_object_type_SearchCompanyWhereInput($__value);
            }, $__value);
        })(($value)['_and'] ?? null)), _or: ((function ($__value) {
            return null === $__value ? null : \array_map(function ($__value) {
                return $this->transform_input_object_type_SearchCompanyWhereInput($__value);
            }, $__value);
        })(($value)['_or'] ?? null)), name: ($this->transform_input_object_type_StringExprInput(($value)['name'] ?? null)), id: ($this->transform_input_object_type_IntExprInput(($value)['id'] ?? null)), withCategory: ($this->transform_enum_type_YesNo(($value)['withCategory'] ?? null)));
    }

    private function transform_input_object_type_CreateUserInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject\CreateUserInputType(email: ((function ($__value) {
            return null === $__value ? null : ($this->transform_scalar_type_String($__value));
        })(($value)['email'] ?? null)), lastname: ($this->transform_scalar_type_String(($value)['lastname'] ?? null)), firstname: ($this->transform_scalar_type_String(($value)['firstname'] ?? null)));
    }

    private function transform_input_object_type_EditUserInput($value)
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType(id: ((function ($__value) {
            return null === $__value ? null : ($this->transform_scalar_type_UserId($__value));
        })(($value)['id'] ?? null)), email: ((function ($__value) {
            return null === $__value ? null : ($this->transform_scalar_type_String($__value));
        })(($value)['email'] ?? null)), lastname: ($this->transform_scalar_type_String(($value)['lastname'] ?? null)), firstname: ($this->transform_scalar_type_String(($value)['firstname'] ?? null)));
    }
}
