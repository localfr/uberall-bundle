<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Logo
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     * @Assert\Url
     */
    private $url;

    /**
     * Attribution constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->description = $payload['description'] ?? null;
        $this->type = $payload['type'] ?? null;
        $this->url = $payload['url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * 
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * 
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * 
     * @return self
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
