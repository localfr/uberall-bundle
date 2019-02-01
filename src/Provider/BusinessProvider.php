<?php

namespace Localfr\UberallBundle\Provider;

/**
 * @property string $id
 * @property string $name
 * @property string $streetAndNo
 * @property string $zip
 * @property string $city
 * @property string $phone
 * @property string $country
 */
class BusinessProvider extends UberallProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getFieldNames(): array
    {
        return [
            'id',
            'name',
            'streetAndNo',
            'zip',
            'city',
            'phone',
            'country',
        ];
    }
}
