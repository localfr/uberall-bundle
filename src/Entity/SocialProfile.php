<?php

namespace Localfr\UberallBundle\Entity;


class SocialProfile
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $url;

    /**
     * SocialProfile constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->type = $payload['type'] ?? null;
        $this->url = $payload['url'] ?? null;
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
     * @return SocialProfile
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
     * @return SocialProfile
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
