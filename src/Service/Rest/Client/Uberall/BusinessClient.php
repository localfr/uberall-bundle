<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\Provider\BusinessProvider as BusinessProvider;
use Localfr\UberallBundle\Exception\BusinessException;
use Symfony\Component\HttpFoundation\Response;

class BusinessClient extends UberallClient
{
    /**
     * @param BusinessProvider $businessData
     *
     * @return mixed
     *
     * @throws BusinessException
     */
    public function create(BusinessProvider $businessData)
    {
        $content = $this->get('/api/businesses/?query=' . $businessData->name);
        if (!$content || 'SUCCESS' !== $content->status) {
            throw new BusinessException('Error while calling Uberall business API.');
        }

        if ($content->response->count > 0) {
            foreach ($content->response->businesses as $business) {
                if ($businessData->name == $business->name) {
                    // @TODO : do it with another way ?
                    echo 'Business ' . $business->name . ' already exists' . PHP_EOL;

                    return $business;
                }
            }
        }

        $json = json_encode([
            'name' => $businessData->name,
            'streetAndNo' => $businessData->streetAndNo ?: '.',
            'zip' => $businessData->zip,
            'city' => $businessData->city ?: '.',
            'phone' => $businessData->phone,
            'country' => $businessData->country ?: 'FR',
        ]);

        $postContent = $this->post('/api/businesses', $json);
        if ('SUCCESS' === $postContent->status) {
            // @TODO : do it with another way ?
            echo 'Business ' . $postContent->response->business->name . ' successfuly created' . PHP_EOL;

            return $postContent->response->business;
        }

        throw new BusinessException(sprintf('Error on business creation : %s', $postContent->message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param int $id uberall businessId to remove
     *
     * @return void
     * @throws BusinessException
     */
    public function remove($id)
    {
        $content = $this->delete('/api/businesses/' . $id);
        if ('SUCCESS' === $content->status) {
            // @TODO : do it with another way ?
            echo 'Business ' . $id . ' successfuly deleted' . PHP_EOL;

            return;
        }

        $message = $content->message ?? var_export($content, true);

        throw new BusinessException(sprintf('Error on business deletion : %s', $message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
