<?php

namespace Localfr\UberallBundle\Service\Rest\QueryParams\Uberall;

use Symfony\Component\Validator\Constraints as Assert;

class UsersQueryParams
{
    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    public $identifier;

    /**
     * @var int
     * @Assert\Positive
     */
    public $locationId;

    /**
     * @var int
     * @Assert\Positive
     */
    public $max;

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
     * @var string
     */
    public $sort;

    /**
     * @param array $payload
     */
    public function __construct(array $payload = [])
    {
        $this->identifier = $payload['identifier'] ?? null;
        $this->locationId = $payload['locationId'] ?? null;
        $this->max = $payload['max'] ?? null;
        $this->offset = $payload['offset'] ?? 0;
        $this->order = $payload['order'] ?? 'asc';
        $this->query = $payload['query'] ?? null;
        $this->sort = $payload['sort'] ?? null;
    }
}
