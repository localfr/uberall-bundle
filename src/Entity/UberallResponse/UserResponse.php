<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;

use Localfr\UberallBundle\Entity\User;

class UserResponse
{
    use UberallResponseTrait;

    /**
     * @return UserObjectResponse|null
     */
    public function getResponse(): ?UserObjectResponse
    {
        return $this->response;
    }

    /**
     * @param UserObjectResponse|null
     * 
     * @return self
     */
    public function setResponse(?UserObjectResponse $response): self
    {
        $this->response = $response;
        return $this;
    }
}


class UserObjectResponse
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserObjectResponse constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->user = $payload['user'] ?? null;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * 
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}