<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator\QueryFinder;

use Attribute;

#[Attribute(
    Attribute::IS_REPEATABLE
    | Attribute::TARGET_CLASS
    | Attribute::TARGET_CLASS_CONSTANT
    | Attribute::TARGET_FUNCTION
    | Attribute::TARGET_METHOD
    | Attribute::TARGET_PROPERTY
)]
final class GQL
{
    public function __construct(public string $query)
    {
    }
}
