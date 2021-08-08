<?php

declare(strict_types=1);

use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function JmvDevelop\GraphqlGenerator\Utils\phpTypeIsNullable;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

test('extractShotName', function (): void {
    assertEquals('Class', extractShortName('\\Abc\\Def\\Ghj\\Class'));
    assertEquals('MyClass', extractShortName('\\Abc\\Def\\Ghj\\MyClass'));
    assertEquals('Class', extractShortName('\\Abc\\Def\\Class'));
    assertEquals('Class', extractShortName('\\Abc\\Class'));
    assertEquals('Class', extractShortName('\\Class'));

    assertEquals('Class', extractShortName('Abc\\Def\\Ghj\\Class'));
    assertEquals('MyClass', extractShortName('Abc\\Def\\Ghj\\MyClass'));
    assertEquals('Class', extractShortName('Abc\\Def\\Class'));
    assertEquals('Class', extractShortName('Abc\\Class'));
    assertEquals('Class', extractShortName('Class'));
});

test('extractBaseNamespace', function (): void {
    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('\\Abc\\Def\\Ghj\\Class'));
    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('\\Abc\\Def\\Ghj\\MyClass'));
    assertEquals('Abc\\Def', extractBaseNamespace('\\Abc\\Def\\Class'));
    assertEquals('Abc', extractBaseNamespace('\\Abc\\Class'));
    assertEquals('', extractBaseNamespace('\\Class'));

    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('Abc\\Def\\Ghj\\Class'));
    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('Abc\\Def\\Ghj\\MyClass'));
    assertEquals('Abc\\Def', extractBaseNamespace('Abc\\Def\\Class'));
    assertEquals('Abc', extractBaseNamespace('Abc\\Class'));
    assertEquals('', extractBaseNamespace('Class'));

    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('Abc\\Def\\Ghj\\Class\\'));
    assertEquals('Abc\\Def\\Ghj', extractBaseNamespace('Abc\\Def\\Ghj\\MyClass\\'));
    assertEquals('Abc\\Def', extractBaseNamespace('Abc\\Def\\Class\\'));
    assertEquals('Abc', extractBaseNamespace('Abc\\Class\\'));
    assertEquals('', extractBaseNamespace('Class\\'));
});

test('phpTypeIsNullable', function (): void {
    assertFalse(phpTypeIsNullable('string'));
    assertFalse(phpTypeIsNullable('string|int'));
    assertTrue(phpTypeIsNullable('string|int|null'));
    assertTrue(phpTypeIsNullable('null'));
    assertTrue(phpTypeIsNullable('null|string'));
    assertTrue(phpTypeIsNullable('null|string|int'));
    assertTrue(phpTypeIsNullable('string|null|null'));
    assertFalse(phpTypeIsNullable('string|NullObject'));
});
