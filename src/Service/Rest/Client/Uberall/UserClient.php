<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Component\Response\UberallResponse;
use Localfr\UberallBundle\Entity\User;
use Localfr\UberallBundle\Entity\UberallResponse\{
    UsersResponse,
    UserResponse,
    UberallGenericResponse
};
use Localfr\UberallBundle\Exception\UserException;
use Localfr\UberallBundle\Service\Rest\QueryParams\Uberall\UsersQueryParams;

class UserClient extends AbstractUberallClient
{
    /**
     * @var string
     */
    private const ENTITY = 'users';

    /**
     * @param int $userId
     *
     * @return UberallResponse
     */
    public function getUser(int $userId): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $userId);
        $esponseEntity = UserResponse::class;
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
     * @param UsersQueryParams $queryParams
     * @return UberallResponse
     */
    public function getUsers(UsersQueryParams $queryParams): UberallResponse
    {
        $validation = $this->validatePayload($queryParams);
        if (null !== $validation) {
            $this->logger->error('User query parameters validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new UserException('User query parameters validation failed.', 0, $validation);
        }

        $service = sprintf('/api/%s?%s', self::ENTITY, \http_build_query($queryParams));
        $responseEntity = UsersResponse::class;
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
     * @param User $newUser
     * @param bool $throw
     *
     * @return UberallResponse
     *
     * @throws UserException
     */
    public function create(User $newUser, bool $throw = true): UberallResponse
    {
        $validation = $this->validatePayload($newUser);
        if (null !== $validation) {
            $this->logger->error('New user validation failed.');
            $this->logger->error(var_export($validation, true));
            throw new UserException('New user validation failed.', 0, $validation);
        }

        $json = $this->serializer->serialize(
            $newUser,
            [
                'skip_null_values' => true
            ]
        );

        $service = sprintf('/api/%s', self::ENTITY);
        $entityResponse = UserResponse::class;
        $response = $this->post($service, $json);
        if (200 !== $response->getStatusCode()) {
            $entityResponse = UberallGenericResponse::class;
            $data = $response->toArray(false);
            $this->logger->error(sprintf('Error while creating user with email=%s.', $newUser->getEmail()));
            if (true === $throw) {
                throw new UserException(
                    'Error while creating user.',
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
     * @param int $id uberall userId to update
     * @param User $user
     * @param bool $throw
     *
     * @return void
     * @throws UserException
     */
    public function update(int $id, User $user, bool $throw = true): UberallResponse
    {
        $service = sprintf('/api/%s/%d', self::ENTITY, $id);
        $responseEntity = UserResponse::class;
        $json = $this->serializer->serialize(
            $user,
            [
                'skip_null_values' => true
            ]
        );

        $response = $this->patch($service, $json);
        if (200 !== $response->getStatusCode()) {
            $responseEntity = UberallGenericResponse::class;
            $this->logger->warning(sprintf('User %d update failed, payload=%s', $id, $json));
            if (true === $throw) {
                throw new UserException(
                    'User update failed.',
                    0,
                    array_merge(["id" => $id], $response->toArray(false))
                );
            }
        } else {
            $this->logger->info(sprintf('User %d sucessfully updated, payload=%s', $id, $json));
        }

        return new UberallResponse(
            $response,
            $this->serializer,
            $responseEntity
        );
    }

    /**
     * @param int $id uberall userId to remove
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
