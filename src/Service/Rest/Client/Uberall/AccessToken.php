<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\src\Exception\UnsolvedTokenException;
use Symfony\Component\HttpFoundation\Response;

class AccessToken extends UberallClient
{
    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * @param UberallClient $client
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param $userEmail
     *
     * @return mixed
     *
     * @throws UnsolvedTokenException
     */
    private function generateUserAccessToken($userEmail)
    {
        if (!empty($userEmail)) {
            throw new UnsolvedTokenException('Email is required.');
        }

        $json = json_encode([
            'email' => $userEmail,
        ]);

        $content = $this->post('/api/users/login', $json);
        if ('SUCCESS' === $content->status) {
            return $content->response->access_token;
        }

        throw new UnsolvedTokenException(sprintf('Unable to get the uberall token, due to the fallowing error %s', $content->message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param $userEmail
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function getAccessToken($userEmail)
    {
        if (!isset($this->accessToken)){
            $this->accessToken = $this->generateUserAccessToken($userEmail);
        }

        return $this->accessToken;
    }
}
