<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator\ObjectField;

use JmvDevelop\GraphqlGenerator\Schema\ObjectField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use Nette\PhpGenerator\Method;

final class IsserObjectFieldGenerator implements ObjectFieldGenerator
{
    public function generateBodyMethod(ObjectType $type, ObjectField $field, Method $method): void
    {
        $method->addBody(\sprintf('return $root->is%s();', \ucfirst($field->getName())));
    }
}
