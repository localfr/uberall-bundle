<?php

namespace Localfr\UberallBundle\Entity;


class OpeningHour extends Hour
{
    /**
     * @var bool
     */
    private $closed;

    /**
     * OpeningHour constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->closed = $payload['closed'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function getClosed(): ?bool
    {
        return $this->closed;
    }

    /**
     * @param bool|null $closed
     * 
     * @return OpeningHour
     */
    public function setClosed(?bool $closed): self
    {
        $this->closed = $closed;
        return $this;
    }
}
