<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;
use Localfr\UberallBundle\Entity\Business;


class BusinessResponse
{
    use UberallResponseTrait;

    /**
     * @return BusinessObjectResponse|null
     */
    public function getResponse(): ?BusinessObjectResponse
    {
        return $this->response;
    }

    /**
     * @param BusinessObjectResponse|null
     * 
     * @return self
     */
    public function setResponse(?BusinessObjectResponse $response): self
    {
        $this->response = $response;
        return $this;
    }
}


class BusinessObjectResponse
{
    /**
     * @var Business
     */
    private $business;

    /**
     * @var Collection|array[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $suggestionsForFields;

    /**
     * @var bool
     */
    private $suggestionsForFieldsAvailable;

    /**
     * BusinessObjectResponse constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->location = $payload['business'] ?? null;

        $this->suggestionsForFields = null;
        if (array_key_exists('suggestionsForFields', $payload) && is_array($payload['suggestionsForFields'] && !empty($payload['suggestionsForFields']))) {
            foreach ($payload['suggestionsForFields'] as $suggestionsForField) {
                $this->addSuggestionsForField($suggestionsForField);
            }
        }

        $this->suggestionsForFieldsAvailable = $payload['suggestionsForFieldsAvailable'] ?? null;
    }

    /**
     * @return Business|null
     */
    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    /**
     * @param Business|null $business
     * 
     * @return self
     */
    public function setBusiness(?Business $business): self
    {
        $this->business = $business;
        return $this;
    }

    /**
     * @return Collection|array[]|null
     */
    public function getSuggestionsForFields(): ?Collection
    {
        return $this->suggestionsForFields;
    }

    /**
     * @param array $suggestionsForField
     *
     * @return self
     */
    public function addSuggestionsForField(array $suggestionsForField): self
    {
        if (null === $this->suggestionsForFields) {
            $this->suggestionsForFields = new ArrayCollection();
        }

        if (!$this->suggestionsForFields->contains($suggestionsForField)) {
            $this->suggestionsForFields[] = $suggestionsForField;
        }
        return $this;
    }

    /**
     * @param array $suggestionsForField
     *
     * @return self
     */
    public function removeSuggestionsForField(array $suggestionsForField): self
    {
        if (null === $this->suggestionsForFields) {
            return $this;
        }

        if ($this->suggestionsForFields->contains($suggestionsForField)) {
            $this->suggestionsForFields->removeElement($suggestionsForField);
        }
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSuggestionsForFieldsAvailable(): ?bool
    {
        return $this->suggestionsForFieldsAvailable;
    }

    /**
     * @param bool|null $suggestionsForFieldsAvailable
     * 
     * @return self
     */
    public function setSuggestionsForFieldsAvailable(?bool $suggestionsForFieldsAvailable): self
    {
        $this->suggestionsForFieldsAvailable = $suggestionsForFieldsAvailable;
        return $this;
    }
}