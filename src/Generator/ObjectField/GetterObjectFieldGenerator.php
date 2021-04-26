<?php

namespace JmvDevelop\GraphqlGenerator\Generator\ObjectField;

use JmvDevelop\GraphqlGenerator\Schema\ObjectField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use Nette\PhpGenerator\Method;

final class GetterObjectFieldGenerator implements ObjectFieldGenerator
{
    public function generateBodyMethod(ObjectType $type, ObjectField $field, Method $method): void
    {
        $method->addBody(\sprintf('return $root->get%s();', \ucfirst($field->getName())));
    }
}
