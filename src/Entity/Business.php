<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;


class Business extends UberallEntityBase
{
    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    private $businessSyncable;

    /**
     * @var string
     */
    private $city;

    /**
     * @var int
     * @Assert\Positive
     */
    private $contractDuration;

    /**
     * @var string
     */
    private $country;

    /**
     * @var Collection|CountryPrice[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $countryPrices;

    /**
     * @var \DateTime
     * @Assert\DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     * @Assert\DateTime
     */
    private $dateExpiration;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultPrice;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultOriginalPrice;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultPriceSetup;

    /**
     * @var \DateTime
     * @Assert\DateTime
     */
    private $effectiveDate;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var int
     * @Assert\Positive
     */
    private $nextProductPlanId;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $numOfLocations;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var ProductPlan
     */
    private $productPlan;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $streetAndNo;

    /**
     * @var string
     * @Assert\Choice(choices={"ENTERPRISE", "SMB"})
     */
    private $type;

    /**
     * @var string
     */
    private $zip;

    /**
     * Location constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->addressLine2 = $payload['addressLine2'] ?? null;
        $this->businessSyncable = $payload['businessSyncable'] ?? null;
        $this->city = $payload['city'] ?? null;
        $this->contractDuration = $payload['contractDuration'] ?? null;
        $this->country = $payload['country'] ?? null;
        
        $this->countryPrices = null;
        if (array_key_exists('countryPrices', $payload) && is_array($payload['countryPrices'] && !empty($payload['countryPrices']))) {
            foreach ($payload['countryPrices'] as $countryPrice) {
                $this->addCountryPrice($countryPrice);
            }
        }
        
        $this->dateCreated = $payload['dateCreated'] ?? null;
        $this->dateExpiration = $payload['dateExpiration'] ?? null;
        $this->defaultPrice = $payload['defaultPrice'] ?? null;
        $this->defaultOriginalPrice = $payload['defaultOriginalPrice'] ?? null;
        $this->defaultPriceSetup = $payload['defaultPriceSetup'] ?? null;
        $this->effectiveDate = $payload['effectiveDate'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->name = $payload['name'] ?? null;
        $this->nextProductPlanId = $payload['nextProductPlanId'] ?? null;
        $this->numOfLocations = $payload['numOfLocations'] ?? null;
        $this->phone = $payload['phone'] ?? null;
        $this->productPlan = $payload['productPlan'] ?? null;
        $this->province = $payload['province'] ?? null;
        $this->status = $payload['status'] ?? null;
        $this->streetAndNo = $payload['streetAndNo'] ?? null;
        $this->type = $payload['type'] ?? null;
        $this->zip = $payload['zip'] ?? null;
        $this->zip = $payload['zip'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    /**
     * @param string|null $addressLine2
     * 
     * @return self
     */
    public function setAddressLine2(?string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getBusinessSyncable(): ?bool
    {
        return $this->businessSyncable;
    }

    /**
     * @param bool|null $businessSyncable
     * 
     * @return self
     */
    public function setBusinessSyncable(?bool $businessSyncable): self
    {
        $this->businessSyncable = $businessSyncable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * 
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getContractDuration(): ?int
    {
        return $this->contractDuration;
    }

    /**
     * @param int|null $contractDuration
     * 
     * @return self
     */
    public function setContractDuration(?int $contractDuration): self
    {
        $this->contractDuration = $contractDuration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * 
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return Collection|PricePerCountry[]|null
     */
    public function getCountryPrices(): ?Collection
    {
        return $this->countryPrices;
    }

    /**
     * @param PricePerCountry $countryPrice
     *
     * @return self
     */
    public function addCountryPrice(PricePerCountry $countryPrice): self
    {
        if (null === $this->countryPrices) {
            $this->countryPrices = new ArrayCollection();
        }

        if (!$this->countryPrices->contains($countryPrice)) {
            $this->countryPrices[] = $countryPrice;
        }
        return $this;
    }

    /**
     * @param PricePerCountry $countryPrice
     *
     * @return self
     */
    public function removeCountryPrice(PricePerCountry $countryPrice): self
    {
        if (null === $this->countryPrices) {
            return $this;
        }

        if ($this->countryPrices->contains($countryPrice)) {
            $this->countryPrices->removeElement($countryPrice);
        }
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
     * @return \DateTimeInterface|null
     */
    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    /**
     * @param \DateTimeInterface|string|null $dateExpiration
     * 
     * @return self
     */
    public function setDateExpiration($dateExpiration = null): self
    {
        if (null !== $dateExpiration && !$dateExpiration instanceof \DateTimeInterface) {
            $dateExpiration = new \DateTime($dateExpiration);
        }
        $this->dateExpiration = $dateExpiration;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultPrice(): ?int
    {
        return $this->defaultPrice;
    }

    /**
     * @param int|null $defaultPrice
     * 
     * @return self
     */
    public function setDefaultPrice(?int $defaultPrice): self
    {
        $this->defaultPrice = $defaultPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultOriginalPrice(): ?int
    {
        return $this->defaultOriginalPrice;
    }

    /**
     * @param int|null $defaultOriginalPrice
     * 
     * @return self
     */
    public function setDefaultOriginalPrice(?int $defaultOriginalPrice): self
    {
        $this->defaultOriginalPrice = $defaultOriginalPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultPriceSetup(): ?int
    {
        return $this->defaultPriceSetup;
    }

    /**
     * @param int|null $defaultPriceSetup
     * 
     * @return self
     */
    public function setDefaultPriceSetup(?int $defaultPriceSetup): self
    {
        $this->defaultPriceSetup = $defaultPriceSetup;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEffectiveDate(): ?\DateTimeInterface
    {
        return $this->effectiveDate;
    }

    /**
     * @param \DateTimeInterface|string|null $effectiveDate
     * 
     * @return self
     */
    public function setEffectiveDate($effectiveDate = null): self
    {
        if (null !== $effectiveDate && !$effectiveDate instanceof \DateTimeInterface) {
            $effectiveDate = new \DateTime($effectiveDate);
        }
        $this->effectiveDate = $effectiveDate;
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
     * @return int|null
     */
    public function getNextProductPlanId(): ?int
    {
        return $this->nextProductPlanId;
    }

    /**
     * @param int|null $nextProductPlanId
     * 
     * @return self
     */
    public function setNextProductPlanId(?int $nextProductPlanId): self
    {
        $this->nextProductPlanId = $nextProductPlanId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumOfLocations(): ?int
    {
        return $this->numOfLocations;
    }

    /**
     * @param int|null $numOfLocations
     * 
     * @return self
     */
    public function setNumOfLocations(?int $numOfLocations): self
    {
        $this->numOfLocations = $numOfLocations;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * 
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return ProductPlan|null
     */
    public function getProductPlan(): ?ProductPlan
    {
        return $this->productPlan;
    }

    /**
     * @param ProductPlan|null $productPlan
     * 
     * @return self
     */
    public function setProductPlan(?ProductPlan $productPlan): self
    {
        $this->productPlan = $productPlan;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     * 
     * @return self
     */
    public function setProvince(?string $province): self
    {
        $this->province = $province;
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
    public function getStreetAndNo(): ?string
    {
        return $this->streetAndNo;
    }

    /**
     * @param string|null $streetAndNo
     * 
     * @return self
     */
    public function setStreetAndNo(?string $streetAndNo): self
    {
        $this->streetAndNo = $streetAndNo;
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
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * 
     * @return self
     */
    public function setZip(?string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }
}
