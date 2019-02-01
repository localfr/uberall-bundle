<?php

namespace Localfr\UberallBundle\Service\Rest\Client;

use Buzz\Browser;
use Localfr\UberallBundle\Exception\UnsolvedTokenException;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class UberallClient
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @param Browser $browser
     * @param Logger $logger
     * @param array $config
     */
    public function __construct(Browser $browser, Logger $logger, array $config)
    {
        $this->browser = $browser;
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * @param string $service
     * @param array $headers
     *
     * @return mixed
     */
    public function get(string $service, array $headers = []): \stdClass
    {
        $response = $this->browser->get($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers));

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param $json
     * @param array $headers
     *
     * @return mixed
     */
    public function post(string $service, $json, array $headers = []): \stdClass
    {
        $response = $this->browser->post($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers), $json);

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param array $headers
     *
     * @return mixed
     */
    public function delete(string $service, array $headers = []): \stdClass
    {
        $response = $this->browser->delete($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers));

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param $json
     * @param array $headers
     *
     * @return mixed
     */
    public function patch(string $service, $json, $headers = []): \stdClass
    {
        $response = $this->browser->patch($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers), $json);

        return json_decode($response->getContent());
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->config['base_url'];
    }

    /**
     * @param $userEmail
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function getAccessToken($userEmail): ?string
    {
        if (!isset($this->accessToken)){
            $this->accessToken = $this->generateUserAccessToken($userEmail);
        }

        return $this->accessToken;
    }

    /**
     * @param $userEmail
     *
     * @return mixed
     *
     * @throws UnsolvedTokenException
     */
    private function generateUserAccessToken($userEmail): string
    {
        if (empty($userEmail)) {
            throw new UnsolvedTokenException('Email is required.');
        }

        $json = json_encode([
            'email' => $userEmail,
        ]);

        $content = $this->post('/api/users/login', $json);
        if ('SUCCESS' === $content->status) {
            return $content->response->access_token;
        }

        throw new UnsolvedTokenException(
            sprintf('Unable to get the uberall token, due to the following error %s', $content->message),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * @return array
     */
    private function getDefaultHeaders(): array
    {
        return [
            'Cache-Control' => 'no-cache',
            'content-type' => 'application/json',
            'privateKey' => $this->config['private_key']
        ];
    }
}
