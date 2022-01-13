<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;
use Localfr\UberallBundle\Entity\User;


class UsersResponse implements UberallResponseInterface
{
    use UberallResponseTrait;

    /**
     * @return UsersCollectionResponse|null
     */
    public function getResponse(): ?UsersCollectionResponse
    {
        return $this->response;
    }

    /**
     * @param UsersCollectionResponse|null $response
     * 
     * @return self
     */
    public function setResponse($response = null): self
    {
        $this->response = $response;
        return $this;
    }
}


class UsersCollectionResponse
{
    use UberallSearchResponseTrait;

    /**
     * @var Collection|User[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $users;

    /**
     * UsersCollectionResponse constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->offset = $payload['offset'] ?? null;
        $this->max = $payload['max'] ?? null;
        $this->count = $payload['count'] ?? null;

        $this->users = null;
        if (array_key_exists('users', $payload) && is_array($payload['users'] && !empty($payload['users']))) {
            foreach ($payload['users'] as $user) {
                $this->addUser($user);
            }
        }
    }

    /**
     * @return Collection|User[]|null
     */
    public function getUsers(): ?Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function addUser(User $user): self
    {
        if (null === $this->users) {
            $this->users = new ArrayCollection();
        }

        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }
        return $this;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function removeUser(User $user): self
    {
        if (null === $this->users) {
            return $this;
        }

        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }
        return $this;
    }
}