<?php

declare(strict_types=1);

use function JmvDevelop\GraphqlGenerator\Utils\extractBaseNamespace;
use function JmvDevelop\GraphqlGenerator\Utils\extractShortName;
use function PHPUnit\Framework\assertEquals;

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
