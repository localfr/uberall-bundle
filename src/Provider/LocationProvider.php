<?php

namespace Localfr\UberallBundle\Provider;

/**
 * @property string $id
 * @property string $identifier
 * @property string $name
 * @property string $street
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property string $businessId
 * @property string $status
 * @property string $country
 * @property string $autoSync
 * @property string $website
 * @property string $email
 * @property string $legalIdent
 */
class LocationProvider extends UberallProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getFieldNames(): array
    {
        return [
            'id',
            'identifier',
            'name',
            'street',
            'city',
            'zip',
            'phone',
            'businessId',
            'status',
            'country',
            'autoSync',
            'website',
            'email',
            'legalIdent',
        ];
    }
}
