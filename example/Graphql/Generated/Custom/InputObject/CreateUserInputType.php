<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\Custom\InputObject;

final class CreateUserInputType
{
    public function __construct(
        public string $email,
        public string | null $lastname,
        public string | null $firstname,
    ) {
    }
}
