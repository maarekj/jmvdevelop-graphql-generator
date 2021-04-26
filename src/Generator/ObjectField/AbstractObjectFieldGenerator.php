<?php

namespace JmvDevelop\GraphqlGenerator\Generator\ObjectField;

use JmvDevelop\GraphqlGenerator\Schema\ObjectField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use Nette\PhpGenerator\Method;

final class AbstractObjectFieldGenerator implements ObjectFieldGenerator
{
    public function generateBodyMethod(ObjectType $type, ObjectField $field, Method $method): void
    {
        $method->setAbstract();
    }
}
