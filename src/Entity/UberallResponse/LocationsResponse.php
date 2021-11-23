<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;
use Localfr\UberallBundle\Entity\Location;


class LocationsResponse implements UberallResponseInterface
{
    use UberallResponseTrait;

    /**
     * @return LocationsCollectionResponse|null
     */
    public function getResponse(): ?LocationsCollectionResponse
    {
        return $this->response;
    }

    /**
     * @param LocationsCollectionResponse|null $response
     * 
     * @return self
     */
    public function setResponse($response = null): self
    {
        $this->response = $response;
        return $this;
    }
}


class LocationsCollectionResponse
{
    use UberallSearchResponseTrait;

    /**
     * @var Collection|Location[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $locations;

    /**
     * LocationsCollectionResponse constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->offset = $payload['offset'] ?? null;
        $this->max = $payload['max'] ?? null;
        $this->count = $payload['count'] ?? null;

        $this->locations = null;
        if (array_key_exists('locations', $payload) && is_array($payload['locations'] && !empty($payload['locations']))) {
            foreach ($payload['locations'] as $location) {
                $this->addLocation($location);
            }
        }
    }

    /**
     * @return Collection|Location[]|null
     */
    public function getLocations(): ?Collection
    {
        return $this->locations;
    }

    /**
     * @param Location $location
     *
     * @return self
     */
    public function addLocation(Location $location): self
    {
        if (null === $this->locations) {
            $this->locations = new ArrayCollection();
        }

        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
        }
        return $this;
    }

    /**
     * @param Location $location
     *
     * @return self
     */
    public function removeLocation(Location $location): self
    {
        if (null === $this->locations) {
            return $this;
        }

        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
        }
        return $this;
    }
}