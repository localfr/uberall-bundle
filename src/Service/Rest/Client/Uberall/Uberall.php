<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\Exception\UserException;

class Uberall extends UberallClient
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
     * @param string $connectedUserEmail
     * @param string|null $email
     *
     * @return string
     * @throws UserException
     * @throws \Exception
     */
    public function getAutologinUrl($connectedUserEmail, $email = null): string
    {
        if (empty($connectedUserEmail)) {
            throw new UserException('Connected user has not email.');
        }
        $user = $this->userClient->getByEmail($connectedUserEmail);

        if (isset($email)) {
            $email = $connectedUserEmail;
            $client = $this->userClient->getByEmail($email);
        } else {
            $client = $user;
        }

        if ($user && $client && count($client->managedLocations)) {
            return sprintf(
                '%s/fr/app/localfr/locationEdit/%s?access_token=%s',
                $this->getBaseUrl(),
                $client->managedLocations[0],
                $this->getAccessToken($connectedUserEmail)
            );
        }

        throw new UserException(sprintf('User %s not exist in Uberall.', $connectedUserEmail));
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
