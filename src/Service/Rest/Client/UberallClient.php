<?php

namespace Localfr\UberallBundle\Service\Rest\Client;

use Localfr\UberallBundle\Exception\UnsolvedTokenException;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

class UberallClient
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var LoggerInterface
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
     * @param HttpClientInterface $httpClient
     * @param LoggerInterface $logger
     * @param array $config
     */
    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger, array $config)
    {
        $this->httpClient = $httpClient;
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
        $response = $this->httpClient->request('GET', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers)
            ]
        );

        return json_decode($response->getContent());
    }

    /**
     * @param string $service
     * @param $json
     * @param array $headers
     *
     * @return mixed
     */
    public function post(string $service, $json, array $headers = []): \stdClass
    {
        $response = $this->httpClient->request('POST', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers),
                'body' => $json
            ]
        );

        return json_decode($response->getContent());
    }

    /**
     * @param string $service
     * @param array $headers
     *
     * @return mixed
     */
    public function delete(string $service, array $headers = []): \stdClass
    {
        $response = $this->httpClient->request('DELETE', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers)
            ]
        );

        return json_decode($response->getContent());
    }

    /**
     * @param string $service
     * @param $json
     * @param array $headers
     *
     * @return mixed
     */
    public function patch(string $service, $json, $headers = []): \stdClass
    {
        $response = $this->httpClient->request('PATCH', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers),
                'body' => $json
            ]
        );

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
