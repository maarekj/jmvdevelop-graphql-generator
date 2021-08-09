<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\SchemaGenerator\TypeGeneratorInterface;

interface WithTypeGenerator
{
    public function getGenerator(): TypeGeneratorInterface;
}
