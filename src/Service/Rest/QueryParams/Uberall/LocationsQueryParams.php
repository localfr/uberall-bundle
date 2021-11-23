<?php

namespace Localfr\UberallBundle\Service\Rest\QueryParams\Uberall;

use Symfony\Component\Validator\Constraints as Assert;

class LocationsQueryParams
{
    const CLASSIFICATION = [
        'REQUIRED', 'BASIC', 'ADVANCED', 'BONUS', 'COMPLETE'
    ];

    const FACEBOOK_STATUS = [
        'CONNECTED', 'NOT_CONNECTED'
    ];

    const FIELD_MASK = [
        'id', 'name', 'identifier', 'street', 'streetNo',
        'streetAndNumber', 'addressExtra', 'zip', 'city',
        'province', 'lat', 'lng', 'addressDisplay',
        'phone', 'fax', 'cellPhone', 'website', 'email',
        'legalIdent', 'taxNumber', 'descriptionShort',
        'descriptionLong', 'imprint', 'openingHoursNotes',
        'status','firstSyncStarted', 'lastSyncStarted',
        'autoSync', 'locationSyncable', 'businessId',
        'googleInsights', 'labels'
    ];

    const GOOGLE_STATUS = [
        'VERIFIED', 'VERIFICATION_STARTED', 'VERIFICATION_NOT_STARTED',
        'NOT_CONNECTED', 'VERIFIED_BY_THIRD_PARTY'
    ];

    const SORT = [
        'name', 'street', 'streetNo', 'zip', 'city', 'phone',
        'cellphone', 'fax', 'website', 'email', 'lastSyncStarted', 'country'
    ];

    const STATUS = [
        'ACTIVE', 'INACTIVE', 'CANCELLED'
    ];

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $businessId;

    /**
     * @var string
     * @Assert\Choice(choices=LocationsQueryParams::CLASSIFICATION)
     */
    public $classification;

    /**
     * @var \DateTime
     * @Assert\DateTime(format=DateTime::ISO8601)
     */
    public $endDateMax;

    /**
     * @var \DateTime
     * @Assert\DateTime
     */
    public $endDateMin;

    /**
     * @var array<int>
     * @Assert\Type("array")
     */
    public $excludedLocationIds;

    /**
     * @var string
     * @Assert\Choice(choices=LocationsQueryParams::FACEBOOK_STATUS)
     */
    public $facebookStatus;

    /**
     * @var array<string>
     * @Assert\Type("array")
     */
    public $fieldMask;

    /**
     * @var string
     * @Assert\Choice(choices=LocationsQueryParams::GOOGLE_STATUS)
     */
    public $googleStatus;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $identifier;

    /**
     * @var array<string>
     * @Assert\Type("array")
     */
    public $labels;

    /**
     * @var array<int>
     * @Assert\Type("array")
     */
    public $locationIds;

    /**
     * @var int
     * @Assert\Positive
     */
    public $max;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    public $needsReview;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $offset = 0;

    /**
     * @var string
     * @Assert\Choice(choices={"asc", "desc"})
     */
    public $order = 'asc';

    /**
     * @var string
     */
    public $query;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    public $selectAll;

    /**
     * @var string
     * @Assert\Choice(choices=LocationsQueryParams::SORT)
     */
    public $sort;

    /**
     * @var string
     * @Assert\Choice(choices=LocationsQueryParams::STATUS)
     */
    public $status;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    public $syncNeeded;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    public $syncStarted;
}
