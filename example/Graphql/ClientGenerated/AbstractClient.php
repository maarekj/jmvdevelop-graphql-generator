<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated;

use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Mapper;

/**
 * @psalm-type T_searchCompaniesWithId = array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}|null}
 * @phpstan-type T_searchCompaniesWithId array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}|null}
 * @psalm-type T_searchCompanies = array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string, categories: list<array{id: string, name: string}>}>}|null}
 * @phpstan-type T_searchCompanies array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string, categories: list<array{id: string, name: string}>}>}|null}
 * @psalm-type T_company1And2Query = array{jmv1: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}|null, jmv2: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}|null}
 * @phpstan-type T_company1And2Query array{jmv1: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}|null, jmv2: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}|null}
 * @psalm-type T_searchCompaniesWithNoArg = array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}|null}
 * @phpstan-type T_searchCompaniesWithNoArg array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}|null}
 */
abstract class AbstractClient
{
    public function __construct(
        protected Mapper $mapper,
    ) {
    }

    abstract public function execute(string $query, array $variables = []): array;

    public function gql_searchCompaniesWithId(): string
    {
        return "query searchCompaniesWithId(\$id: Int!) {\n  searchCompanies(where: { id: { eq: \$id } }) {\n    currentPage\n    nbPages\n    count\n    maxPerPage\n    results {\n      id\n      name\n    }\n  }\n}";
    }

    /**
     * @psalm-return T_searchCompaniesWithId
     * @phpstan-return T_searchCompaniesWithId
     */
    public function parse_searchCompaniesWithId(array $data)
    {
        return [
            'searchCompanies' => null === $data ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['currentPage']), 'nbPages' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['nbPages']), 'count' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['count']), 'maxPerPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['maxPerPage']), 'results' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : array_map(function ($___data) {
                            return [
                                'id' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })($___data['name']),
                            ];
                        }, $___data);
                    })($___data['results']),
                ];
            })($data['searchCompanies']),
        ];
    }

    /**
     * @psalm-return T_searchCompaniesWithId
     * @phpstan-return T_searchCompaniesWithId
     */
    public function execute_searchCompaniesWithId(int $id)
    {
        $___result = $this->execute($this->gql_searchCompaniesWithId(), ['id' => $this->mapper->php_to_graphql_Int($id)]);

        return $this->parse_searchCompaniesWithId($___result);
    }

    public function gql_searchCompanies(): string
    {
        return "query searchCompanies(\$where: SearchCompanyWhereInput = null) {\n  searchCompanies(where: \$where) {\n    currentPage\n    nbPages\n    count\n    maxPerPage\n    results {\n      id\n      name\n      categories {\n        id\n        name\n      }\n    }\n  }\n}";
    }

    /**
     * @psalm-return T_searchCompanies
     * @phpstan-return T_searchCompanies
     */
    public function parse_searchCompanies(array $data)
    {
        return [
            'searchCompanies' => null === $data ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['currentPage']), 'nbPages' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['nbPages']), 'count' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['count']), 'maxPerPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['maxPerPage']), 'results' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : array_map(function ($___data) {
                            return [
                                'id' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })($___data['name']), 'categories' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : array_map(function ($___data) {
                                        return [
                                            'id' => null === $___data ? null : (function ($___data) {
                                                return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                            })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                                return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                            })($___data['name']),
                                        ];
                                    }, $___data);
                                })($___data['categories']),
                            ];
                        }, $___data);
                    })($___data['results']),
                ];
            })($data['searchCompanies']),
        ];
    }

    /**
     * @psalm-return T_searchCompanies
     * @phpstan-return T_searchCompanies
     */
    public function execute_searchCompanies(SearchCompanyWhereInput|null $where)
    {
        $___result = $this->execute($this->gql_searchCompanies(), ['where' => null === $where ? null : $this->mapper->php_to_graphql_SearchCompanyWhereInput($where)]);

        return $this->parse_searchCompanies($___result);
    }

    public function gql_company1And2Query(): string
    {
        return "query company1And2Query {\n  jmv1: company(id: 1) {\n    id\n    name\n    categories {\n      id\n      name\n      __typename\n    }\n    __typename\n  }\n  jmv2: company(id: 2) {\n    id\n    name\n    categories {\n      id\n      name\n      __typename\n    }\n    __typename\n  }\n}";
    }

    /**
     * @psalm-return T_company1And2Query
     * @phpstan-return T_company1And2Query
     */
    public function parse_company1And2Query(array $data)
    {
        return [
            'jmv1' => null === $data ? null : (function ($___data) {
                return null === $___data ? null : [
                    'id' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                    })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                    })($___data['name']), 'categories' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : array_map(function ($___data) {
                            return [
                                'id' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })($___data['name']), '__typename' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $___data;
                                })($___data['__typename']),
                            ];
                        }, $___data);
                    })($___data['categories']), '__typename' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $___data;
                    })($___data['__typename']),
                ];
            })($data['jmv1']), 'jmv2' => null === $data ? null : (function ($___data) {
                return null === $___data ? null : [
                    'id' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                    })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                    })($___data['name']), 'categories' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : array_map(function ($___data) {
                            return [
                                'id' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })($___data['name']), '__typename' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $___data;
                                })($___data['__typename']),
                            ];
                        }, $___data);
                    })($___data['categories']), '__typename' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $___data;
                    })($___data['__typename']),
                ];
            })($data['jmv2']),
        ];
    }

    /**
     * @psalm-return T_company1And2Query
     * @phpstan-return T_company1And2Query
     */
    public function execute_company1And2Query()
    {
        $___result = $this->execute($this->gql_company1And2Query(), []);

        return $this->parse_company1And2Query($___result);
    }

    public function gql_searchCompaniesWithNoArg(): string
    {
        return "query searchCompaniesWithNoArg {\n  searchCompanies {\n    currentPage\n    nbPages\n    count\n    maxPerPage\n    results {\n      id\n      name\n    }\n  }\n}";
    }

    /**
     * @psalm-return T_searchCompaniesWithNoArg
     * @phpstan-return T_searchCompaniesWithNoArg
     */
    public function parse_searchCompaniesWithNoArg(array $data)
    {
        return [
            'searchCompanies' => null === $data ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['currentPage']), 'nbPages' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['nbPages']), 'count' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['count']), 'maxPerPage' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })($___data['maxPerPage']), 'results' => null === $___data ? null : (function ($___data) {
                        return null === $___data ? null : array_map(function ($___data) {
                            return [
                                'id' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })($___data['id']), 'name' => null === $___data ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })($___data['name']),
                            ];
                        }, $___data);
                    })($___data['results']),
                ];
            })($data['searchCompanies']),
        ];
    }

    /**
     * @psalm-return T_searchCompaniesWithNoArg
     * @phpstan-return T_searchCompaniesWithNoArg
     */
    public function execute_searchCompaniesWithNoArg()
    {
        $___result = $this->execute($this->gql_searchCompaniesWithNoArg(), []);

        return $this->parse_searchCompaniesWithNoArg($___result);
    }
}
