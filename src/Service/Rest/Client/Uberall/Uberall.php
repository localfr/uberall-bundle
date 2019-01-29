<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\src\Exception\UserException;

class Uberall extends UberallClient
{
    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var Business
     */
    private $business;

    /**
     * @param AccessToken $accessToken
     * @param UberallClient $client
     */
    public function __construct(AccessToken $accessToken, User $user, Location $location, Business $business)
    {
        $this->accessToken = $accessToken;
        $this->user = $user;
        $this->location = $location;
        $this->business = $business;
    }

    /**
     * @param string $connectedUserEmail
     * @param string|null $email
     *
     * @return string
     * @throws UserException
     */
    public function getAutologinUrl($connectedUserEmail, $email = null)
    {
        if (!empty($connectedUserEmail)) {
            throw new UserException('Connected user has not email.');
        }
        $user = $this->user->getByEmail($connectedUserEmail);

        if (isset($email)) {
            $email = $connectedUserEmail;
            $client = $this->user->getByEmail($email);
        } else {
            $client = $user;
        }
        if ($user && $client && count($client['managedLocations'])) {
            return sprintf(
                '%s/fr/app/localfr/locationEdit/%s?access_token=%s',
                $this->getBaseUrl(),
                $client['managedLocations'][0],
                $this->accessToken->getAccessToken($connectedUserEmail)
            );
        }

        throw new UserException(sprintf('User %s not exist in Uberall.', $connectedUserEmail));
    }

    /**
     * @param array $data
     *
     * @return array with the 3 keys corresponding to the 3 objects which constitute a functioning uberall account
     */
    public function createUberallEntities($data)
    {
        $return = [];
        try {
            $return['business'] = $this->business->create($data);
            $return['location'] = $this->location->create($data, $return['business']);
            $return['user'] = $this->user->create($data, $return['location']);
            $return['message'] = ' without any error';
        } catch (\Exception $exception) {
            $return['message'] = sprintf(' with following error : %', $exception->getMessage());
        }

        return $return;
    }

    /**
     * @return User
     */
    public function getUserProvider()
    {
        return $this->user;
    }

    /**
     * @return Location
     */
    public function getLocationProvider()
    {
        return $this->location;
    }

    /**
     * @return Business
     */
    public function getBusinessProvider()
    {
        return $this->business;
    }
}
