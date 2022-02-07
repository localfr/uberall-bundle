<?php

namespace Localfr\UberallBundle\Entity;

class AttributeWrapper
{
    /** @var string */
    private $displayName;

    /** @var string */
    private $groupDisplayName;

    /** @var string */
    private $externalId;

    /** @var string */
    private $value;

    /** @var string */
    private $valueType;

    /** @var array<string> */
    private $valueMetadata;

    /**
     * AttributeWrapper constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->displayName = $payload['displayName'] ?? null;
        $this->groupDisplayName = $payload['groupDisplayName'] ?? null;
        $this->externalId = $payload['externalId'] ?? null;
        $this->value = $payload['value'] ?? null;
        $this->valueType = $payload['valueType'] ?? null;
        $this->valueMetadata = $payload['valueMetadata'] ?? [];
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param string|null $displayName
     * 
     * @return AttributeWrapper
     */
    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupDisplayName(): ?string
    {
        return $this->groupDisplayName;
    }

    /**
     * @param string|null $groupDisplayName
     * 
     * @return AttributeWrapper
     */
    public function setGroupDisplayName(?string $groupDisplayName): self
    {
        $this->groupDisplayName = $groupDisplayName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param string|null $externalId
     * 
     * @return AttributeWrapper
     */
    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * 
     * @return AttributeWrapper
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValueType(): ?string
    {
        return $this->valueType;
    }

    /**
     * @param string|null $valueType
     * 
     * @return AttributeWrapper
     */
    public function setValueType(?string $valueType): self
    {
        $this->valueType = $valueType;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getValueMetadata(): array
    {
        return $this->valueMetadata;
    }

    /**
     * @param array<string>|null $valueMetadata
     * 
     * @return AttributeWrapper
     */
    public function setValueMetadata(?array $valueMetadata = []): self
    {
        $this->valueMetadata = $valueMetadata ?: [];
        return $this;
    }
}
