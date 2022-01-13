<?php

namespace Localfr\UberallBundle\Entity;


abstract class UberallEntityBase
{
    /**
     * @var int
     */
    private $id;

    /**
     * UberallEntityBase constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->id = $payload['id'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * 
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
