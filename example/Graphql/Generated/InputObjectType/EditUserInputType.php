<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;

final class EditUserInputType
{
    public function __construct(
        public User $id,
        public string $email,
        public string | null $lastname,
        public string | null $firstname,
    ) {
    }
}
