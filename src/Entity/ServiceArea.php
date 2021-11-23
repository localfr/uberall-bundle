<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class ServiceArea
{
    /**
     * @var string
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $placeId;

    /**
     * ServiceArea constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->name = $payload['name'] ?? null;
        $this->placeId = $payload['placeId'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * 
     * @return ServiceArea
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     * 
     * @return ServiceArea
     */
    public function setPlaceId(?string $placeId): self
    {
        $this->placeId = $placeId;
        return $this;
    }
}
