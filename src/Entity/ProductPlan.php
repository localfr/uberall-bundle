<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;

class ProductPlan
{
    /**
     * @var int
     * @Assert\Positive
     */
    private $billingPeriod;

    /**
     * @var Collection|PricePerCountry[]
     */
    private $countryPrices;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultMarketDevelopmentFunds;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultOriginalPrice;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    private $defaultPlan;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultPrice;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $defaultPriceSetup;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     * @Assert\NotBlank
     */
    private $duration;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $features;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var int
     */
    private $initialBillingPeriod;

    /**
     * @var int
     */
    private $initialDuration;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     * @Assert\Choice(choices={"PENDING_APPROVAL", "ACTIVE", "INACTIVE"})
     */
    private $status;

    /**
     * PricePerCountry constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->billingPeriod = $payload['billingPeriod'] ?? null;

        $this->countryPrices = null;
        if (array_key_exists('countryPrices', $payload) && is_array($payload['countryPrices'] && !empty($payload['countryPrices']))) {
            foreach ($payload['countryPrices'] as $countryPrice) {
                $this->addCountryPrice($countryPrice);
            }
        }

        $this->defaultMarketDevelopmentFunds = $payload['defaultMarketDevelopmentFunds'] ?? null;
        $this->defaultOriginalPrice = $payload['defaultOriginalPrice'] ?? null;
        $this->defaultPlan = $payload['defaultPlan'] ?? null;
        $this->defaultPrice = $payload['defaultPrice'] ?? null;
        $this->defaultPriceSetup = $payload['defaultPriceSetup'] ?? null;
        $this->description = $payload['description'] ?? null;
        $this->duration = $payload['duration'] ?? null;

        $this->features = null;
        if (array_key_exists('features', $payload) && is_array($payload['features'] && !empty($payload['features']))) {
            foreach ($payload['features'] as $feature) {
                $this->addFeature($feature);
            }
        }

        $this->identifier = $payload['identifier'] ?? null;
        $this->initialBillingPeriod = $payload['initialBillingPeriod'] ?? null;
        $this->initialDuration = $payload['initialDuration'] ?? null;
        $this->name = $payload['name'] ?? null;
        $this->status = $payload['status'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getBillingPeriod(): ?int
    {
        return $this->billingPeriod;
    }

    /**
     * @param int|null $billingPeriod
     * 
     * @return self
     */
    public function setBillingPeriod(?int $billingPeriod): self
    {
        $this->billingPeriod = $billingPeriod;
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
     * @return int|null
     */
    public function getDefaultMarketDevelopmentFunds(): ?int
    {
        return $this->defaultMarketDevelopmentFunds;
    }

    /**
     * @param int|null $defaultMarketDevelopmentFunds
     * 
     * @return self
     */
    public function setDefaultMarketDevelopmentFunds(?int $defaultMarketDevelopmentFunds): self
    {
        $this->defaultMarketDevelopmentFunds = $defaultMarketDevelopmentFunds;
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
     * @return bool|null
     */
    public function getDefaultPlan(): ?bool
    {
        return $this->defaultPlan;
    }

    /**
     * @param bool|null $defaultPlan
     * 
     * @return self
     */
    public function setDefaultPlan(?bool $defaultPlan): self
    {
        $this->defaultPlan = $defaultPlan;
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
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     * 
     * @return self
     */
    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getFeatures(): ?Collection
    {
        return $this->features;
    }

    /**
     * @param string $feature
     *
     * @return self
     */
    public function addFeature(string $feature): self
    {
        if (null === $this->features) {
            $this->features = new ArrayCollection();
        }

        if (!$this->features->contains($feature)) {
            $this->features[] = $feature;
        }
        return $this;
    }

    /**
     * @param string $feature
     *
     * @return self
     */
    public function removeFeature(string $feature): self
    {
        if (null === $this->features) {
            return $this;
        }

        if ($this->features->contains($feature)) {
            $this->features->removeElement($feature);
        }
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
     * @return int|null
     */
    public function getInitialBillingPeriod(): ?int
    {
        return $this->initialBillingPeriod;
    }

    /**
     * @param int|null $initialBillingPeriod
     * 
     * @return self
     */
    public function setInitialBillingPeriod(?int $initialBillingPeriod): self
    {
        $this->initialBillingPeriod = $initialBillingPeriod;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInitialDuration(): ?int
    {
        return $this->initialDuration;
    }

    /**
     * @param int|null $initialDuration
     * 
     * @return self
     */
    public function setInitialDuration(?int $initialDuration): self
    {
        $this->initialDuration = $initialDuration;
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
}
