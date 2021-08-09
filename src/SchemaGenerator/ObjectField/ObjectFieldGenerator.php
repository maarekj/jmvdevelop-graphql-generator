<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator\ObjectField;

use JmvDevelop\GraphqlGenerator\Schema\ObjectField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use Nette\PhpGenerator\Method;

interface ObjectFieldGenerator
{
    public function generateBodyMethod(ObjectType $type, ObjectField $field, Method $method): void;
}
