<?php

namespace Localfr\UberallBundle\Entity;

class Service extends UberallEntityBase
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * Service constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->identifier = $payload['identifier'] ?? null;
        $this->title = $payload['title'] ?? null;
        $this->description = $payload['description'] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * 
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }

    /**
     * @param string $name
     * 
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->$name;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * 
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
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
}
