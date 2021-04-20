<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

final class SchemaDefinition
{
    /**
     * @param list<QueryField>                                                   $queryFields
     * @param list<MutationField>                                                $mutationFields
     * @param list<EnumType|InputObjectType|InterfaceType|ObjectType|ScalarType> $types
     */
    public function __construct(
        private array $queryFields = [],
        private array $mutationFields = [],
        private array $types = [],
    ) {
    }

    /** @return list<QueryField> */
    public function getQueryFields(): array
    {
        return $this->queryFields;
    }

    /** @param list<QueryField> $queryFields */
    public function setQueryFields(array $queryFields): self
    {
        $this->queryFields = $queryFields;

        return $this;
    }

    public function addQueryField(QueryField $field): self
    {
        $this->queryFields[] = $field;

        return $this;
    }

    /** @return list<EnumType|InputObjectType|InterfaceType|ObjectType|ScalarType> */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param list<EnumType|InputObjectType|InterfaceType|ObjectType|ScalarType> $types */
    public function setTypes(array $types): self
    {
        $this->types = $types;

        return $this;
    }

    public function addType(ScalarType | InputObjectType | ObjectType | EnumType | InterfaceType $typeDefinition): self
    {
        $this->types[] = $typeDefinition;

        return $this;
    }

    /** @return list<MutationField> */
    public function getMutationFields(): array
    {
        return $this->mutationFields;
    }

    /** @param list<MutationField> $mutationFields */
    public function setMutationFields(array $mutationFields): self
    {
        $this->mutationFields = $mutationFields;

        return $this;
    }

    public function addMutationField(MutationField $mutationField): self
    {
        $this->mutationFields[] = $mutationField;

        return $this;
    }
}
