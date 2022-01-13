<?php

namespace Localfr\UberallBundle\Entity;

class PricePerCountry
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $marketDevelopmentFunds;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $priceSetup;

    /**
     * PricePerCountry constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->country = $payload['country'] ?? null;
        $this->marketDevelopmentFunds = $payload['marketDevelopmentFunds'] ?? null;
        $this->price = $payload['price'] ?? null;
        $this->priceSetup = $payload['priceSetup'] ?? null;
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
     * @return int|null
     */
    public function getMarketDevelopmentFunds(): ?int
    {
        return $this->marketDevelopmentFunds;
    }

    /**
     * @param int|null $marketDevelopmentFunds
     * 
     * @return self
     */
    public function setMarketDevelopmentFunds(?int $marketDevelopmentFunds): self
    {
        $this->marketDevelopmentFunds = $marketDevelopmentFunds;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     * 
     * @return self
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPriceSetup(): ?int
    {
        return $this->priceSetup;
    }

    /**
     * @param int|null $priceSetup
     * 
     * @return self
     */
    public function setPriceSetup(?int $priceSetup): self
    {
        $this->priceSetup = $priceSetup;
        return $this;
    }
}
