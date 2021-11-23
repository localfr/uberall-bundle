<?php

namespace Localfr\UberallBundle\Component\Response;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Localfr\UberallBundle\Component\Serializer\UberallSerializer;


class UberallResponse
{
    /**
     * @var string
     */
    private $entity;

    /**
     * @var UberallSerializer
     */
    private $serializer;

    /**
     * @var ResponseInterface
     */
    private $rawResponse;

    /**
     * @var array
     */
    private const RESPONSE_HEADERS = [
        'date'
    ];

    /**
     * UberallResponse Constructor
     * 
     * @param ResponseInterface $response
     * @param UberallSerializer $serializer
     * @param string $entity
     */
    public function __construct(ResponseInterface $response, UberallSerializer $serializer, string $entity = null)
    {
        $this->rawResponse = $response;
        $this->serializer = $serializer;
        $this->entity = $entity;
    }

    /**
     * @param bool $throw
     * 
     * @return mixed
     */
    public function deserialize(bool $throw = true)
    {
        if (null === $this->entity) {
            return null;
        }

        return $this->serializer->deserialize(
            $this->rawResponse->getContent($throw),
            $this->entity
        );
    }

    /**
     * @param bool $throw
     * 
     * @return string
     */
    public function getContent(bool $throw = true): string
    {
        return $this->rawResponse->getContent($throw);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->rawResponse->getStatusCode();
    }

    /**
     * @param bool $throw
     * 
     * @return array
     */
    public function getHeaders(bool $throw = true): array
    {
        return $this->rawResponse->getHeaders($throw);
    }

    /**
     * @param bool $throw
     * 
     * @return array
     */
    public function buildResponseHeaders(bool $throw = true): array
    {
        /** @var array $headers */
        $headers = [];

        foreach ($this->getHeaders($throw) as $header => $value) {
            if (in_array($header, self::RESPONSE_HEADERS)) {
                $headers[$header] = $value;
            }
        }

        return $headers;
    }
}
