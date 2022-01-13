<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;
use Localfr\UberallBundle\Entity\Business;


class BusinessesResponse implements UberallResponseInterface
{
    use UberallResponseTrait;

    /**
     * @return BusinessesCollectionResponse|null
     */
    public function getResponse(): ?BusinessesCollectionResponse
    {
        return $this->response;
    }

    /**
     * @param BusinessesCollectionResponse|null $response
     * 
     * @return self
     */
    public function setResponse($response = null): self
    {
        $this->response = $response;
        return $this;
    }
}


class BusinessesCollectionResponse
{
    use UberallSearchResponseTrait;

    /**
     * @var Collection|Business[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $businesses;

    /**
     * BusinessesCollectionResponse constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->offset = $payload['offset'] ?? null;
        $this->max = $payload['max'] ?? null;
        $this->count = $payload['count'] ?? null;

        $this->businesses = null;
        if (array_key_exists('businesses', $payload) && is_array($payload['businesses'] && !empty($payload['businesses']))) {
            foreach ($payload['businesses'] as $business) {
                $this->addBusiness($business);
            }
        }
    }

    /**
     * @return Collection|Business[]|null
     */
    public function getBusinesses(): ?Collection
    {
        return $this->businesses;
    }

    /**
     * @param Business $business
     *
     * @return self
     */
    public function addBusiness(Business $business): self
    {
        if (null === $this->businesses) {
            $this->businesses = new ArrayCollection();
        }

        if (!$this->businesses->contains($business)) {
            $this->businesses[] = $business;
        }
        return $this;
    }

    /**
     * @param Business $business
     *
     * @return self
     */
    public function removeBusiness(Business $business): self
    {
        if (null === $this->businesses) {
            return $this;
        }

        if ($this->businesses->contains($business)) {
            $this->businesses->removeElement($business);
        }
        return $this;
    }
}