<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;

class Listing extends UberallEntityBase
{
    /**
     * @var array
     * @Assert\Type("array")
     */
    private $accountInfo;

    /**
     * @var string
     */
    private $claimStatus;

    /**
     * @var string
     */
    private $connectStatus;

    /**
     * @var array
     * @Assert\Type("array")
     */
    private $data;

    /**
     * @var \DateTime
     */
    private $lastChecked;

    /**
     * @var \DateTime
     */
    private $lastSuccessfulUpdate;

    /**
     * @var string
     */
    private $listingId;

    /**
     * @var string
     */
    private $listingUrl;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $mandatoryFields;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $syncStatus;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $typeName;

    /**
     * Listing constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->accountInfo = $payload['accountInfo'] ?? null;
        $this->claimStatus = $payload['claimStatus'] ?? null;
        $this->connectStatus = $payload['connectStatus'] ?? null;
        $this->data = $payload['data'] ?? null;
        $this->lastChecked = $payload['lastChecked'] ?? null;
        $this->lastSuccessfulUpdate = $payload['lastSuccessfulUpdate'] ?? null;
        $this->listingId = $payload['listingId'] ?? null;
        $this->listingUrl = $payload['listingUrl'] ?? null;
        
        $this->mandatoryFields = null;
        if (array_key_exists('mandatoryFields', $payload) && is_array($payload['mandatoryFields'] && !empty($payload['mandatoryFields']))) {
            foreach ($payload['mandatoryFields'] as $mandatoryField) {
                $this->addMandatoryField($mandatoryField);
            }
        }

        $this->status = $payload['status'] ?? null;
        $this->syncStatus = $payload['syncStatus'] ?? null;
        $this->type = $payload['type'] ?? null;
        $this->typeName = $payload['typeName'] ?? null;
    }

    /**
     * @return array|null
     */
    public function getAccountInfo(): ?array
    {
        return $this->accountInfo;
    }

    /**
     * @param array|null $accountInfo
     * 
     * @return self
     */
    public function setAccountInfo(?array $accountInfo = []): self
    {
        $this->accountInfo = $accountInfo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClaimStatus(): ?string
    {
        return $this->claimStatus;
    }

    /**
     * @param string|null $claimStatus
     * 
     * @return self
     */
    public function setClaimStatus(?string $claimStatus): self
    {
        $this->claimStatus = $claimStatus;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getConnectStatus(): ?string
    {
        return $this->connectStatus;
    }

    /**
     * @param string|null $connectStatus
     * 
     * @return self
     */
    public function setConnectStatus(?string $connectStatus): self
    {
        $this->connectStatus = $connectStatus;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     * 
     * @return self
     */
    public function setData(?array $data = []): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastChecked(): ?\DateTimeInterface
    {
        return $this->lastChecked;
    }

    /**
     * @param \DateTimeInterface|string|null $lastChecked
     * 
     * @return self
     */
    public function setLastChecked($lastChecked = null): self
    {
        if (null !== $lastChecked && !$lastChecked instanceof \DateTimeInterface) {
            $lastChecked = new \DateTime($lastChecked);
        }
        $this->lastChecked = $lastChecked;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastSuccessfulUpdate(): ?\DateTimeInterface
    {
        return $this->lastSuccessfulUpdate;
    }

    /**
     * @param \DateTimeInterface|string|null $lastSuccessfulUpdate
     * 
     * @return self
     */
    public function setLastSuccessfulUpdate($lastSuccessfulUpdate = null): self
    {
        if (null !== $lastSuccessfulUpdate && !$lastSuccessfulUpdate instanceof \DateTimeInterface) {
            $lastSuccessfulUpdate = new \DateTime($lastSuccessfulUpdate);
        }
        $this->lastSuccessfulUpdate = $lastSuccessfulUpdate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getListingId(): ?string
    {
        return $this->listingId;
    }

    /**
     * @param string|null $listingId
     * 
     * @return self
     */
    public function setListingId(?string $listingId): self
    {
        $this->listingId = $listingId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getListingUrl(): ?string
    {
        return $this->listingUrl;
    }

    /**
     * @param string|null $listingUrl
     * 
     * @return self
     */
    public function setListingUrl(?string $listingUrl): self
    {
        $this->listingUrl = $listingUrl;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getMandatoryFields(): ?Collection
    {
        return $this->mandatoryFields;
    }

    /**
     * @param string $mandatoryField
     *
     * @return self
     */
    public function addMandatoryField(string $mandatoryField): self
    {
        if (null === $this->mandatoryFields) {
            $this->mandatoryFields = new ArrayCollection();
        }

        if (!$this->mandatoryFields->contains($mandatoryField)) {
            $this->mandatoryFields[] = $mandatoryField;
        }
        return $this;
    }

    /**
     * @param string $mandatoryField
     *
     * @return self
     */
    public function removeMandatoryField(string $mandatoryField): self
    {
        if (null === $this->mandatoryFields) {
            return $this;
        }

        if ($this->mandatoryFields->contains($mandatoryField)) {
            $this->mandatoryFields->removeElement($mandatoryField);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * 
     * @return self
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSyncStatus(): ?string
    {
        return $this->syncStatus;
    }

    /**
     * @param string|null $syncStatus
     * 
     * @return self
     */
    public function setSyncStatus(?string $syncStatus): self
    {
        $this->syncStatus = $syncStatus;
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
    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    /**
     * @param string|null $typeName
     * 
     * @return self
     */
    public function setTypeName(?string $typeName): self
    {
        $this->typeName = $typeName;
        return $this;
    }
}
