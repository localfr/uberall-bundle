<?php

namespace Localfr\UberallBundle\Entity;

class Category extends UberallEntityBase
{
    /** @var string */
    private $name;

    /** @var Category */
    private $parent;

    /** @var bool */
    private $selectable;

    /**
     * Category constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->name = $payload['name'] ?? null;
        $this->parent = $payload['parent'] ?? null;
        $this->selectable = $payload['selectable'] ?? null;
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
     * @return Category|null
     */
    public function getParent(): ?Category
    {
        return $this->parent;
    }

    /**
     * @param Category|null $parent
     * 
     * @return self
     */
    public function setParent(?Category $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSelectable(): ?bool
    {
        return $this->selectable;
    }

    /**
     * @param bool|null $value
     * 
     * @return self
     */
    public function setSelectable(?bool $selectable): self
    {
        $this->selectable = $selectable;
        return $this;
    }
}
