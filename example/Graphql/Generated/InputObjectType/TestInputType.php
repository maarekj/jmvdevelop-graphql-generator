<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

final class TestInputType
{
    /**
     * @param null|'DEFAULT'|'NO'|'YES'            $enum
     * @param 'DEFAULT'|'NO'|'YES'                 $requiredEnum
     * @param null|list<null|'DEFAULT'|'NO'|'YES'> $listEnum
     * @param list<null|'DEFAULT'|'NO'|'YES'>      $requiredListEnum
     * @param list<'DEFAULT'|'NO'|'YES'>           $requiredListRequiredEnum
     */
    public function __construct(
        public string|null $enum = null,
        public string $requiredEnum,
        public array|null $listEnum = null,
        public array $requiredListEnum,
        public array $requiredListRequiredEnum,
    ) {
    }

    /**
     * @param null|'DEFAULT'|'NO'|'YES' $enum
     */
    public function _withEnum(string|null $enum): TestInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: $enum, requiredEnum: $this->requiredEnum, listEnum: $this->listEnum, requiredListEnum: $this->requiredListEnum, requiredListRequiredEnum: $this->requiredListRequiredEnum);
    }

    /**
     * @param 'DEFAULT'|'NO'|'YES' $requiredEnum
     */
    public function _withRequiredEnum(string $requiredEnum): TestInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: $this->enum, requiredEnum: $requiredEnum, listEnum: $this->listEnum, requiredListEnum: $this->requiredListEnum, requiredListRequiredEnum: $this->requiredListRequiredEnum);
    }

    /**
     * @param null|list<null|'DEFAULT'|'NO'|'YES'> $listEnum
     */
    public function _withListEnum(array|null $listEnum): TestInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: $this->enum, requiredEnum: $this->requiredEnum, listEnum: $listEnum, requiredListEnum: $this->requiredListEnum, requiredListRequiredEnum: $this->requiredListRequiredEnum);
    }

    /**
     * @param list<null|'DEFAULT'|'NO'|'YES'> $requiredListEnum
     */
    public function _withRequiredListEnum(array $requiredListEnum): TestInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: $this->enum, requiredEnum: $this->requiredEnum, listEnum: $this->listEnum, requiredListEnum: $requiredListEnum, requiredListRequiredEnum: $this->requiredListRequiredEnum);
    }

    /**
     * @param list<'DEFAULT'|'NO'|'YES'> $requiredListRequiredEnum
     */
    public function _withRequiredListRequiredEnum(array $requiredListRequiredEnum): TestInputType
    {
        return new \JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\TestInputType(enum: $this->enum, requiredEnum: $this->requiredEnum, listEnum: $this->listEnum, requiredListEnum: $this->requiredListEnum, requiredListRequiredEnum: $requiredListRequiredEnum);
    }
}
