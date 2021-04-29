<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

interface WithName
{
    public function getName(): string;
}
