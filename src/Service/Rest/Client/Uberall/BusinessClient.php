<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Component\Response\UberallResponse;
use Localfr\UberallBundle\Entity\Business;
use Localfr\UberallBundle\Entity\UberallResponse\{
    BusinessesResponse,
    BusinessResponse,
    UberallGenericResponse
};
use Localfr\UberallBundle\Exception\BusinessException;
use Localfr\UberallBundle\Service\Rest\QueryParams\Uberall\BusinessesQueryParams;


class BusinessClient extends AbstractUberallClient
{
    /**
     * @var string
     */
    private const ENTITY = 'businesses';

    /**
     * @param int $businessId
     *
     * @return UberallResponse
     */
    public function getBusiness(int $businessId): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $businessId);
        $entityResponse = BusinessResponse::class;
        $response = $this->get($service);
        if (200 !== $response->getStatusCode()) {
            $entityResponse = UberallGenericResponse::class;
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $entityResponse
        );
    }

    /**
     * @param BusinessesQueryParams $queryParams
     * @return UberallResponse
     */
    public function getBusinesses(BusinessesQueryParams $queryParams): UberallResponse
    {
        $validation = $this->validatePayload($queryParams);
        if (null !== $validation) {
            $this->logger->error('Business query parameters validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new BusinessException('Business query parameters validation failed.', 0, $validation);
        }

        $service = sprintf('/api/%s?%s', self::ENTITY, \http_build_query($queryParams));
        $responseEntity = BusinessesResponse::class;
        $response = $this->get($service);
        if (200 !== $response->getStatusCode()) {
            $responseEntity = UberallGenericResponse::class;
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $responseEntity
        );
    }

    /**
     * @param Business $newBusiness
     * @param bool $throw
     *
     * @return UberallResponse
     *
     * @throws BusinessException
     */
    public function create(Business $newBusiness, bool $throw = true): UberallResponse
    {
        $validation = $this->validatePayload($newBusiness);
        if (null !== $validation) {
            $this->logger->error('New business validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new BusinessException('New business validation failed.', 0, $validation);
        }

        $json = $this->serializer->serialize(
            $newBusiness,
            [
                'skip_null_values' => true
            ]
        );

        $service = sprintf('/api/%s', self::ENTITY);
        $entityResponse = BusinessResponse::class;
        $response = $this->post($service, $json);
        if (200 !== $response->getStatusCode()) {
            $entityResponse = UberallGenericResponse::class;
            $data = $response->toArray(false);
            $this->logger->error(sprintf('Error while creating business with name=%s.', $newBusiness->getName()));
            if (true === $throw) {
                throw new BusinessException(
                    'Error while creating business.',
                    0,
                    ["responseData" => $data]
                );
            }
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $entityResponse
        );
    }

    /**
     * @param int $id uberall businessId to update
     * @param Business $business
     * @param bool $throw
     *
     * @return void
     * @throws BusinessException
     */
    public function update(int $id, Business $business, bool $throw = true): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $id);
        $responseEntity = BusinessResponse::class;
        $json = $this->serializer->serialize(
            $business,
            [
                'skip_null_values' => true
            ]
        );

        $response = $this->patch($service, $json);
        if (200 !== $response->getStatusCode()) {
            $responseEntity = UberallGenericResponse::class;
            $this->logger->warning(sprintf('Business %d update failed, payload=%s', $id, $json));
            if (true === $throw) {
                throw new BusinessException(
                    'Business update failed.',
                    0,
                    array_merge(["id" => $id], $response->toArray(false))
                );
            }
        } else {
            $this->logger->info(sprintf('Business %d sucessfully updated, payload=%s', $id, $json));
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $responseEntity
        );
    }

    /**
     * @param int $id uberall businessId to remove
     *
     * @return UberallResponse
     */
    public function remove(int $id): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $id);
        $response = $this->delete($service);
        
        return new UberallResponse(
            $response,
            $this->serializer,
            UberallGenericResponse::class
        );
    }
}
