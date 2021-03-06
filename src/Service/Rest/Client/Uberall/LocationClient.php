<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\Provider\LocationProvider;
use Localfr\UberallBundle\Exception\LocationException;
use Symfony\Component\HttpFoundation\Response;

class LocationClient extends UberallClient
{
    /**
     * @param $locationId
     *
     * @return mixed
     */
    public function getLocation($locationId)
    {
        $content = $this->get('/api/locations/' . $locationId);

        return $content->response->location ?? null;
    }

    /**
     * @return array
     */
    public function getLocations(int $maxLocations = 50000)
    {
        $content = $this->get('/api/locations?max=' . $maxLocations);
        if ('SUCCESS' === $content->status && $content->response && 0 !== $content->response->count) {
            return $content->response->locations;
        }

        return [];
    }

    /**
     * @param array LocationProvider $locationData
     *
     * @return mixed
     *
     * @throws LocationException
     */
    public function create(LocationProvider $locationData)
    {
        $content = $this->get('/api/locations?identifier=' . $locationData->identifier);
        if (!$content || 'SUCCESS' !== $content->status) {
            throw new LocationException('Error while calling Uberall location API.');
        }

        if ($content->response->count > 0) {
            foreach ($content->response->locations as $location) {
                if ($locationData->name == $location->name) {
                    $this->logger->addInfo(sprintf('Location %s already exists', $location->name));

                    return $location;
                }
            }
        }

        $json = json_encode([
            'identifier' => $locationData->identifier,
            'name' => $locationData->name,
            'street' => $locationData->street ?: '.',
            'city' => $locationData->city ?: '.',
            'zip' => $locationData->zip,
            'phone' => $locationData->phone,
            'businessId' => $locationData->businessId,
            'status' => $locationData->status ?: 'ACTIVE',
            'country' => $locationData->country ?: 'FR',
            'autoSync' => $locationData->autoSync ?: 'true',
            'website' => $locationData->website,
            'email' => $locationData->email,
            'legalIdent' => $locationData->legalIdent
        ]);

        $postContent = $this->post('/api/locations', $json);
        if ('SUCCESS' === $postContent->status) {
            $this->logger->addInfo(sprintf('Location %s successfully created', $postContent->response->location->name));

            return $postContent->response->location;
        }

        throw new LocationException(sprintf('Error on location creation : %s', $postContent->message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param int $id uberall locationId to change the status
     * @param string $status
     *
     * @return void
     * @throws LocationException
     */
    public function changeStatus($id, $status)
    {
        $content = $this->patch('/api/locations/' . $id, json_encode(['status' => $status]));
        if ('SUCCESS' === $content->status) {
            $this->logger->addInfo(sprintf('Status of location %d successfully modified (status %s)', $id, $status));

            return;
        }

        $message = $content->message ?? var_export($content, true);
        throw new LocationException(sprintf('Error on location status %s change : %s', $status, $message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $id uberall locationId to remove
     *
     * @return void
     * @throws LocationException
     */
    public function remove($id)
    {
        $content = $this->delete('/api/locations/' . $id);
        if ('SUCCESS' === $content->status) {
            $this->logger->addInfo(sprintf('Location %d successfully deleted', $id));

            return;
        }

        $message = $content->message ?? var_export($content, true);
        throw new LocationException(sprintf('Error on location deletion : %s', $message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
