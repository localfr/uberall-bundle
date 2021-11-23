<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\{HttpClientInterface, ResponseInterface};
use Localfr\UberallBundle\Component\Serializer\UberallSerializer;
use Localfr\UberallBundle\Exception\UnsolvedTokenException;

abstract class AbstractUberallClient
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
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var UberallSerializer
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var array
     */
    private const REQUEST_HEADERS = [
        'Accept' => 'application/json',
        'Cache-Control' => 'no-cache',
        'Content-Type' => 'application/json'
    ];

    /**
     * @param HttpClientInterface $httpClient
     * @param LoggerInterface $logger
     * @param ContainerInterface $container
     * @param UberallSerializer $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        HttpClientInterface $httpClient,
        LoggerInterface $logger,
        ContainerInterface $container,
        UberallSerializer $serializer,
        ValidatorInterface $validator
    ) {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->container = $container;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param string $service
     * @param array $headers
     *
     * @return ResponseInterface
     */
    public function get(string $service, array $headers = []): ResponseInterface
    {
        return $this->httpClient->request('GET', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers)
            ]
        );
    }

    /**
     * @param string $service
     * @param $json
     * @param array $headers
     *
     * @return ResponseInterface
     */
    public function post(string $service, $json, array $headers = []): ResponseInterface
    {
        return $this->httpClient->request('POST', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers),
                'body' => $json
            ]
        );
    }

    /**
     * @param string $service
     * @param array $headers
     *
     * @return ResponseInterface
     */
    public function delete(string $service, array $headers = []): ResponseInterface
    {
        return $this->httpClient->request('DELETE', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers)
            ]
        );
    }

    /**
     * @param string $service
     * @param $json
     * @param array $headers
     *
     * @return ResponseInterface
     */
    public function patch(string $service, $json, $headers = []): ResponseInterface
    {
        return $this->httpClient->request('PATCH', $this->getBaseUrl() . $service,
            [
                'headers' => array_merge($this->getDefaultHeaders(), $headers),
                'body' => $json
            ]
        );
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->getConfig('base_url');
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
        return array_merge(
            self::REQUEST_HEADERS,
            [
                'privateKey' => $this->getConfig('private_key')
            ]
        );
    }

    /**
     * @param string $offset
     *
     * @return null|string|array
     */
    private function getConfig(?string $offset = null)
    {
        $config = $this->container->getParameter('localfr_uberall_config');

        if (null === $offset) {
            return $config;
        }

        return $config[$offset] ?? null;
    }

    /**
     * @param mixed $model
     * @param ValidatorInterface $validator
     * 
     * @return array|null
     */
    protected function validatePayload($model): ?array
    {
        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            /** @var array $errorObj */
            $errorObj = [];
            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                array_push(
                    $errorObj,
                    [
                        $error->getPropertyPath() => $error->getMessage()
                    ]
                );
            }
            return $errorObj;
        }

        return null;
    }
}
