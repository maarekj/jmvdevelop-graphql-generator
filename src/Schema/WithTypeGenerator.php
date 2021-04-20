<?php

namespace JmvDevelop\GraphqlGenerator\Schema;

use JmvDevelop\GraphqlGenerator\Generator\TypeGeneratorInterface;

interface WithTypeGenerator
{
    public function getGenerator(): TypeGeneratorInterface;
}
