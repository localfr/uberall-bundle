<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Attribution
{
    /**
     * @var Logo
     * @Assert\Type("Localfr\UberallBundle\Entity\Logo")
     */
    private $logo;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank
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
        $this->logo = $payload['logo'] ?? null;
        $this->name = $payload['name'] ?? null;
        $this->url = $payload['url'] ?? null;
    }

    /**
     * @return Logo|null
     */
    public function getLogo(): ?Logo
    {
        return $this->logo;
    }

    /**
     * @param Logo|null $logo
     * 
     * @return self
     */
    public function setLogo(?Logo $logo): self
    {
        $this->logo = $logo;
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
