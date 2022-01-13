<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Component\Response\UberallResponse;
use Localfr\UberallBundle\Entity\Location;
use Localfr\UberallBundle\Entity\UberallResponse\{
    LocationsResponse,
    LocationResponse,
    UberallGenericResponse
};
use Localfr\UberallBundle\Exception\LocationException;
use Localfr\UberallBundle\Service\Rest\QueryParams\Uberall\LocationsQueryParams;

class LocationClient extends AbstractUberallClient
{
    /**
     * @var string
     */
    private const ENTITY = 'locations';

    /**
     * @param int $locationId
     *
     * @return UberallResponse
     */
    public function getLocation(int $locationId): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $locationId);
        $esponseEntity = LocationResponse::class;
        $response = $this->get($service);
        if (200 !== $response->getStatusCode()) {
            $esponseEntity = UberallGenericResponse::class;
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $esponseEntity
        );
    }

    /**
     * @param LocationsQueryParams $queryParams
     * @return UberallResponse
     */
    public function getLocations(LocationsQueryParams $queryParams): UberallResponse
    {
        $validation = $this->validatePayload($queryParams);
        if (null !== $validation) {
            $this->logger->error('Location query parameters validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new LocationException('Location query parameters validation failed.', 0, $validation);
        }

        $service = sprintf('/api/%s?%s', self::ENTITY, \http_build_query($queryParams));
        $responseEntity = LocationsResponse::class;
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
     * @param Location $newLocation
     * @param bool $throw
     *
     * @return UberallResponse
     *
     * @throws LocationException
     */
    public function create(Location $newLocation, bool $throw = true): UberallResponse
    {
        $validation = $this->validatePayload($newLocation);
        if (null !== $validation) {
            $this->logger->error('New location validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new LocationException('New location validation failed.', 0, $validation);
        }

        $json = $this->serializer->serialize(
            $newLocation,
            [
                'skip_null_values' => true
            ]
        );

        $service = sprintf('/api/%s', self::ENTITY);
        $entityResponse = LocationResponse::class;
        $response = $this->post($service, $json);
        if (200 !== $response->getStatusCode()) {
            $entityResponse = UberallGenericResponse::class;
            $data = $response->toArray(false);
            $this->logger->error(sprintf('Error while creating location with name=%s.', $newLocation->getName()));
            if (true === $throw) {
                throw new LocationException(
                    'Error while creating location.',
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
     * @param int $id uberall locationId to update
     * @param Location $location
     * @param bool $throw
     *
     * @return UberallResponse
     * @throws LocationException
     */
    public function update(int $id, Location $location, bool $throw = true): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $id);
        $responseEntity = LocationResponse::class;
        $json = $this->serializer->serialize(
            $location,
            [
                'skip_null_values' => true
            ]
        );

        $response = $this->patch($service, $json);
        if (200 !== $response->getStatusCode()) {
            $responseEntity = UberallGenericResponse::class;
            $this->logger->warning(sprintf('Location %d update failed, payload=%s', $id, $json));
            if (true === $throw) {
                throw new LocationException(
                    'Location update failed.',
                    0,
                    array_merge(["id" => $id], $response->toArray(false))
                );
            }
        } else {
            $this->logger->info(sprintf('Location %d sucessfully updated, payload=%s', $id, $json));
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $responseEntity
        );
    }

    /**
     * @param int $id uberall locationId to remove
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
