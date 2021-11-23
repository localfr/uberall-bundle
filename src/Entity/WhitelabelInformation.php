<?php

namespace Localfr\UberallBundle\Entity;

class WhitelabelInformation extends UberallEntityBase
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $name;

    /**
     * Label constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->identifier = $payload['identifier'] ?? null;
        $this->name = $payload['name'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string|null $identifier
     * 
     * @return self
     */
    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
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
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
