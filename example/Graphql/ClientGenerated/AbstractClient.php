<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated;

use JmvDevelop\GraphqlGenerator\Example\Graphql\ClientGenerated\InputObject\SearchCompanyWhereInput;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Mapper;

abstract class AbstractClient
{
    public function __construct(protected Mapper $mapper)
    {
    }

    abstract public function execute(string $query, array $variables = []): array;

    public function gql_company1And2Query(): string
    {
        return "query company1And2Query {\n  jmv1: company(id: 1) {\n    id\n    name\n    categories {\n      id\n      name\n      __typename\n    }\n    __typename\n  }\n  jmv2: company(id: 2) {\n    id\n    name\n    categories {\n      id\n      name\n      __typename\n    }\n    __typename\n  }\n}";
    }

    /**
     * @return array{jmv1: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}, jmv2: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}}
     */
    public function parse_company1And2Query(array $data)
    {
        return [
            'jmv1' => ($data) === null ? null : (function ($___data) {
                return null === $___data ? null : [
                    'id' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                    })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                    })(($___data)['name']), 'categories' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : \array_map(function ($___data) {
                            return [
                                'id' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })(($___data)['name']), '__typename' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $___data;
                                })(($___data)['__typename']),
                            ];
                        }, $___data);
                    })(($___data)['categories']), '__typename' => ($___data) === null ? null : (function ($___data) {
                                return null === $___data ? null : $___data;
                            })(($___data)['__typename']),
                ];
            })(($data)['jmv1']), 'jmv2' => ($data) === null ? null : (function ($___data) {
                    return null === $___data ? null : [
                        'id' => ($___data) === null ? null : (function ($___data) {
                            return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                        })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                            return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                        })(($___data)['name']), 'categories' => ($___data) === null ? null : (function ($___data) {
                            return null === $___data ? null : \array_map(function ($___data) {
                                return [
                                    'id' => ($___data) === null ? null : (function ($___data) {
                                        return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                    })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                        return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                    })(($___data)['name']), '__typename' => ($___data) === null ? null : (function ($___data) {
                                        return null === $___data ? null : $___data;
                                    })(($___data)['__typename']),
                                ];
                            }, $___data);
                        })(($___data)['categories']), '__typename' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $___data;
                                })(($___data)['__typename']),
                    ];
                })(($data)['jmv2']),
        ];
    }

    /**
     * @return array{jmv1: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}, jmv2: array{id: string, name: string, categories: list<array{id: string, name: string, __typename: string}>, __typename: string}}
     */
    public function execute_company1And2Query()
    {
        $___result = $this->execute($this->gql_company1And2Query(), []);

        return $this->parse_company1And2Query($___result);
    }

    public function gql_searchCompaniesWithId(): string
    {
        return "query searchCompaniesWithId(\$id: Int!) {\n  searchCompanies(where: {id: {eq: \$id}}) {\n    currentPage\n    nbPages\n    count\n    maxPerPage\n    results {\n      id\n      name\n    }\n  }\n}";
    }

    /**
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}}
     */
    public function parse_searchCompaniesWithId(array $data)
    {
        return [
            'searchCompanies' => ($data) === null ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['currentPage']), 'nbPages' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['nbPages']), 'count' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['count']), 'maxPerPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['maxPerPage']), 'results' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : \array_map(function ($___data) {
                            return [
                                'id' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })(($___data)['name']),
                            ];
                        }, $___data);
                    })(($___data)['results']),
                ];
            })(($data)['searchCompanies']),
        ];
    }

    /**
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}}
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
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string, categories: list<array{id: string, name: string}>}>}}
     */
    public function parse_searchCompanies(array $data)
    {
        return [
            'searchCompanies' => ($data) === null ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['currentPage']), 'nbPages' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['nbPages']), 'count' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['count']), 'maxPerPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['maxPerPage']), 'results' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : \array_map(function ($___data) {
                            return [
                                'id' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })(($___data)['name']), 'categories' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : \array_map(function ($___data) {
                                        return [
                                            'id' => ($___data) === null ? null : (function ($___data) {
                                                return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                            })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                                return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                            })(($___data)['name']),
                                        ];
                                    }, $___data);
                                })(($___data)['categories']),
                            ];
                        }, $___data);
                    })(($___data)['results']),
                ];
            })(($data)['searchCompanies']),
        ];
    }

    /**
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string, categories: list<array{id: string, name: string}>}>}}
     */
    public function execute_searchCompanies(SearchCompanyWhereInput | null $where)
    {
        $___result = $this->execute($this->gql_searchCompanies(), ['where' => ($where) === null ? null : $this->mapper->php_to_graphql_SearchCompanyWhereInput($where)]);

        return $this->parse_searchCompanies($___result);
    }

    public function gql_searchCompaniesWithNoArg(): string
    {
        return "query searchCompaniesWithNoArg {\n  searchCompanies {\n    currentPage\n    nbPages\n    count\n    maxPerPage\n    results {\n      id\n      name\n    }\n  }\n}";
    }

    /**
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}}
     */
    public function parse_searchCompaniesWithNoArg(array $data)
    {
        return [
            'searchCompanies' => ($data) === null ? null : (function ($___data) {
                return null === $___data ? null : [
                    'currentPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['currentPage']), 'nbPages' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['nbPages']), 'count' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['count']), 'maxPerPage' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : $this->mapper->graphql_to_php_Int($___data);
                    })(($___data)['maxPerPage']), 'results' => ($___data) === null ? null : (function ($___data) {
                        return null === $___data ? null : \array_map(function ($___data) {
                            return [
                                'id' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_ID($___data);
                                })(($___data)['id']), 'name' => ($___data) === null ? null : (function ($___data) {
                                    return null === $___data ? null : $this->mapper->graphql_to_php_String($___data);
                                })(($___data)['name']),
                            ];
                        }, $___data);
                    })(($___data)['results']),
                ];
            })(($data)['searchCompanies']),
        ];
    }

    /**
     * @return array{searchCompanies: array{currentPage: int, nbPages: int, count: int, maxPerPage: int, results: list<array{id: string, name: string}>}}
     */
    public function execute_searchCompaniesWithNoArg()
    {
        $___result = $this->execute($this->gql_searchCompaniesWithNoArg(), []);

        return $this->parse_searchCompaniesWithNoArg($___result);
    }
}
