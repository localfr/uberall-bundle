<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

class UberallClient
{
    /**
     * @var UserClient
     */
    private $userClient;

    /**
     * @var LocationClient
     */
    private $locationClient;

    /**
     * @var BusinessClient
     */
    private $businessClient;

    /**
     * @param BusinessClient $businessClient
     * @param LocationClient $locationClient
     * @param UserClient $userClient
     */
    public function __construct(
        BusinessClient $businessClient,
        LocationClient $locationClient,
        UserClient $userClient
    ) {
        $this->businessClient = $businessClient;
        $this->locationClient = $locationClient;
        $this->userClient = $userClient;
    }

    /**
     * @param UserClient $userClient
     *
     * @return Uberall
     */
    public function setUserClient(UserClient $userClient): self
    {
        $this->userClient = $userClient;

        return $this;
    }

    /**
     * @param LocationClient $locationClient
     *
     * @return Uberall
     */
    public function setLocationClient(LocationClient $locationClient): self
    {
        $this->locationClient = $locationClient;

        return $this;
    }

    /**
     * @param BusinessClient $businessClient
     *
     * @return Uberall
     */
    public function setBusinessClient(BusinessClient $businessClient): self
    {
        $this->businessClient = $businessClient;

        return $this;
    }

    /**
     * @return UserClient
     */
    public function getUserClient(): UserClient
    {
        return $this->userClient;
    }

    /**
     * @return LocationClient
     */
    public function getLocationClient(): LocationClient
    {
        return $this->locationClient;
    }

    /**
     * @return BusinessClient
     */
    public function getBusinessClient(): BusinessClient
    {
        return $this->businessClient;
    }
}
