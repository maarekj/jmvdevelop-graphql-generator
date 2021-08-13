<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\ClientGenerator;

interface ScalarConfig
{
    public function name(): string;

    public function getPhpType(): string;

    public function getPsalmType(): string;
}
