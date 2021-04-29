<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Schema;

interface WithSuffixNamespace
{
    public function getSuffixNamespace(): string;
}
