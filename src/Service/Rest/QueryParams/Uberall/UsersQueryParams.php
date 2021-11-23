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
}
