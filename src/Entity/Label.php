<?php

namespace Localfr\UberallBundle\Entity;

class Label
{
    /**
     * @var bool
     */
    private $adminOnly;

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
        $this->adminOnly = $payload['adminOnly'] ?? null;
        $this->name = $payload['name'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function isAdminOnly(): ?bool
    {
        return $this->adminOnly;
    }

    /**
     * @param bool|null $adminOnly
     * 
     * @return self
     */
    public function setAdminOnly(?bool $adminOnly): self
    {
        $this->adminOnly = $adminOnly;
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
