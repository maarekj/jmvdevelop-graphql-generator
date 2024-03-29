<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\SchemaGenerator\ObjectField;

use JmvDevelop\GraphqlGenerator\Schema\ObjectField;
use JmvDevelop\GraphqlGenerator\Schema\ObjectType;
use Nette\PhpGenerator\Method;

final class CallbackObjectFieldGenerator implements ObjectFieldGenerator
{
    /**
     * @param callable(ObjectType, ObjectField, Method):void $callback
     */
    public function __construct(private $callback)
    {
    }

    public function generateBodyMethod(ObjectType $type, ObjectField $field, Method $method): void
    {
        $callback = $this->callback;
        $callback($type, $field, $method);
    }
}
