<?php

namespace Localfr\UberallBundle\Service\Rest\QueryParams\Uberall;

use Symfony\Component\Validator\Constraints as Assert;

class BusinessesQueryParams
{
    const FIELD_MASK = [
        'id', 'identifier', 'name', 'type', 'streetAndNo', 'addressLine2',
        'province', 'zip', 'city','phone', 'country', 'status', 'canSync',
        'dateCreated', 'defaultPrice','defaultOriginalPrice', 'defaultPriceSetup',
        'productPlan', 'nextProductPlan', 'numOfLocations'
    ];

    const SORT = [
        'name', 'streetAndNo', 'city', 'zip', 'phone'
    ];

    const STATUS = [
        'ACTIVE', 'INACTIVE'
    ];

    /**
     * @var array<int>
     * @Assert\Type("array")
     */
    public $businessIds;

    /**
     * @var array<string>
     * @Assert\Type("array")
     */
    public $fieldMask;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $identifier;

    /**
     * @var int
     * @Assert\Positive
     */
    public $max;

    /**
     * @var int
     * @Assert\Positive
     */
    public $maxLocations;

    /**
     * @var int
     * @Assert\Positive
     */
    public $minLocations;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $offset = 0;

    /**
     * @var string
     */
    public $query;

    /**
     * @var string
     * @Assert\Choice(choices=BusinessesQueryParams::SORT)
     */
    public $sort;

    /**
     * @var string
     * @Assert\Choice(choices=BusinessesQueryParams::STATUS)
     */
    public $status;

    /**
     * @param array $payload
     */
    public function __construct(array $payload = [])
    {
        $this->businessIds = $payload['businessIds'] ?? null;
        $this->fieldMask = $payload['fieldMask'] ?? null;
        $this->googleStatus = $payload['googleStatus'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->max = $payload['max'] ?? null;
        $this->maxLocations = $payload['maxLocations'] ?? null;
        $this->minLocations = $payload['minLocations'] ?? null;
        $this->offset = $payload['offset'] ?? 0;
        $this->query = $payload['query'] ?? null;
        $this->sort = $payload['sort'] ?? null;
    }
}
