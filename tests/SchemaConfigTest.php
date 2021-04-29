<?php

declare(strict_types=1);

use JmvDevelop\GraphqlGenerator\Schema\SchemaConfig;
use JmvDevelop\GraphqlGenerator\Schema\SchemaDefinition;
use function PHPUnit\Framework\assertEquals;

test('pathForFQCN', function (): void {
    $config = new SchemaConfig(
        out: '/var/www/graphql',
        namespace: 'MyAcme\\App\\GraphQL',
        schema: new SchemaDefinition(),
    );

    assertEquals('/Generator/ObjectType/MyObjectType.php', $config->pathForFQCN('MyAcme\\App\\GraphQL\\Generator\\ObjectType\\MyObjectType'));
});
