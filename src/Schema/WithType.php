<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

interface WithType
{
    public function getType(): string;
}
