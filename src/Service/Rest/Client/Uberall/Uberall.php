<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\src\Exception\UserException;

class Uberall extends UberallClient
{
    /**
     * @var UserClient
     */
    private $user;

    /**
     * @var LocationClient
     */
    private $location;

    /**
     * @var BusinessClient
     */
    private $business;

    /**
     * @param string $connectedUserEmail
     * @param string|null $email
     *
     * @return string
     * @throws UserException
     * @throws \Exception
     */
    public function getAutologinUrl($connectedUserEmail, $email = null)
    {
        if (empty($connectedUserEmail)) {
            throw new UserException('Connected user has not email.');
        }
        $user = $this->user->getByEmail($connectedUserEmail);

        if (isset($email)) {
            $email = $connectedUserEmail;
            $client = $this->user->getByEmail($email);
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
     * @param UserClient $user
     *
     * @return Uberall
     */
    public function setUserClient(UserClient $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param LocationClient $location
     *
     * @return Uberall
     */
    public function setLocationClient(LocationClient $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @param BusinessClient $business
     *
     * @return Uberall
     */
    public function setBusinessClient(BusinessClient $business): self
    {
        $this->business = $business;

        return $this;
    }

    /**
     * @return UserClient
     */
    public function getUserClient(): UserClient
    {
        return $this->user;
    }

    /**
     * @return LocationClient
     */
    public function getLocationClient(): LocationClient
    {
        return $this->location;
    }

    /**
     * @return BusinessClient
     */
    public function getBusinessClient(): BusinessClient
    {
        return $this->business;
    }
}
