<?php

namespace Localfr\UberallBundle\src\Provider;

/**
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $whitelabelInformationIdentifier
 * @property string $managedLocations
 * @property string $password
 * @property string $preferredLanguage
 * @property string $role
 * @property string $status
 */
class User extends UberallProvider
{
    protected function getFieldNames(): array
    {
        return [
            'email',
            'firstname',
            'lastname',
            'whitelabelInformationIdentifier',
            'managedLocations',
            'password',
            'preferredLanguage',
            'role',
            'status',
        ];
    }
}