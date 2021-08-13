<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Custom\Scalar;

use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\Scalar\AbstractDateTimeTzType;

final class DateTimeTzType extends AbstractDateTimeTzType
{
    public function serialize(\DateTimeImmutable $value): string | int | float | null | bool
    {
        return $value->format(\DateTimeInterface::RFC3339_EXTENDED);
    }

    public static function staticParseValue(float | int | string | null | bool $value): \DateTimeImmutable
    {
        if (null !== $value && \is_string($value)) {
            $date = \DateTimeImmutable::createFromFormat(\DateTimeInterface::RFC3339_EXTENDED, $value);
            if (false !== $date) {
                return $date;
            }
        }

        throw new Error('Invalid date');
    }

    public function parseValue(float | int | string | null | bool $value): \DateTimeImmutable
    {
        return self::staticParseValue($value);
    }

    public function parseLiteral(Node $valueNode, ?array $variables): \DateTimeImmutable
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: '.$valueNode->kind, [$valueNode]);
        }

        $date = \DateTimeImmutable::createFromFormat(\DateTimeInterface::RFC3339_EXTENDED, $valueNode->value);
        if (false !== $date) {
            return $date;
        }

        throw new Error('Invalid date');
    }
}
