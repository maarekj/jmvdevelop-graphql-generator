<?php

declare(strict_types=1);

namespace JmvDevelop\GraphqlGenerator\Example\Graphql\MutationField;

use JmvDevelop\GraphqlGenerator\Example\Entity\User;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\InputObjectType\EditUserInputType;
use JmvDevelop\GraphqlGenerator\Example\Graphql\Generated\MutationField\AbstractEditUserMutation;
use function JmvDevelop\GraphqlGenerator\Utils\strDef;

final class EditUserMutation extends AbstractEditUserMutation
{
    public function resolve(EditUserInputType $data): User
    {
        $user = $data->id;

        $user->setEmail($data->email);
        $user->setLastname(strDef($data->lastname, ''));
        $user->setFirstname(strDef($data->firstname, ''));

        return $user;
    }
}
