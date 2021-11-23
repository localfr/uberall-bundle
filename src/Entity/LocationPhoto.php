<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class LocationPhoto
{
    /** @var int */
    private $cropHeight;

    /** @var int */
    private $cropOffsetX;

    /** @var int */
    private $cropOffsetY;

    /** @var int */
    private $cropWidth;

    /** @var \DateTime */
    private $dateCreated;

    /** @var string */
    private $description;

    /** @var string */
    private $identifier;

    /** @var \DateTime */
    private $lastUpdated;

    /** @var int */
    private $order;

    /** @var string */
    private $sourceUrl;

    /** @var string */
    private $type;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $url;

    /**
     * LocationPhoto constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->cropHeight = $payload['cropHeight'] ?? null;
        $this->cropOffsetX = $payload['cropOffsetX'] ?? null;
        $this->cropOffsetY = $payload['cropOffsetY'] ?? null;
        $this->cropWidth = $payload['cropWidth'] ?? null;
        $this->dateCreated = $payload['dateCreated'] ?? null;
        $this->description = $payload['description'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->lastUpdated = $payload['lastUpdated'] ?? null;
        $this->order = $payload['order'] ?? null;
        $this->sourceUrl = $payload['sourceUrl'] ?? null;
        $this->type = $payload['type'] ?? null;
        $this->url = $payload['url'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getCropHeight(): ?int
    {
        return $this->cropHeight;
    }

    /**
     * @param int|null $cropHeight
     * 
     * @return self
     */
    public function setCropHeight(?int $cropHeight): self
    {
        $this->cropHeight = $cropHeight;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCropOffsetX(): ?int
    {
        return $this->cropOffsetX;
    }

    /**
     * @param int|null $cropOffsetX
     * 
     * @return self
     */
    public function setCropOffsetX(?int $cropOffsetX): self
    {
        $this->cropOffsetX = $cropOffsetX;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCropOffsetY(): ?int
    {
        return $this->cropOffsetY;
    }

    /**
     * @param int|null $cropOffsetY
     * 
     * @return self
     */
    public function setCropOffsetY(?int $cropOffsetY): self
    {
        $this->cropOffsetY = $cropOffsetY;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCropWidth(): ?int
    {
        return $this->cropWidth;
    }

    /**
     * @param int|null $cropWidth
     * 
     * @return self
     */
    public function setCropWidth(?int $cropWidth): self
    {
        $this->cropWidth = $cropWidth;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTimeInterface|string|null $dateCreated
     * 
     * @return self
     */
    public function setDateCreated($dateCreated = null): self
    {
        if (null !== $dateCreated && !$dateCreated instanceof \DateTimeInterface) {
            $dateCreated = new \DateTime($dateCreated);
        }
        $this->dateCreated = $dateCreated;
        return $this;
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
     * @return \DateTimeInterface|null
     */
    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    /**
     * @param \DateTimeInterface|string|null $lastUpdated
     * 
     * @return self
     */
    public function setLastUpdated($lastUpdated = null): self
    {
        if (null !== $lastUpdated && !$lastUpdated instanceof \DateTimeInterface) {
            $lastUpdated = new \DateTime($lastUpdated);
        }
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }

    /**
     * @param int|null $order
     * 
     * @return self
     */
    public function setOrder(?int $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceUrl(): ?string
    {
        return $this->sourceUrl;
    }

    /**
     * @param string|null $sourceUrl
     * 
     * @return self
     */
    public function setSourceUrl(?string $sourceUrl): self
    {
        $this->sourceUrl = $sourceUrl;
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
