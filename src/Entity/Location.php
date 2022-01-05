<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;


class Location extends UberallEntityBase
{
    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $activeDirectoriesCount;

    /**
     * @var int
     * @Assert\PositiveOrZero
     */
    private $activeListingsCount;

    /**
     * @var bool
     */
    private $addressDisplay;

    /**
     * @var string
     */
    private $addressExtra;

    /**
     * @var Collection|AttributeWrapper[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $attributes;

    /**
     * @var bool
     */
    private $autoSync;

    /**
     * @var int
     * @Assert\NotBlank
     */
    private $businessId;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $brands;

    /**
     * @var Collection|int[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $categories;

    /**
     * @var string
     */
    private $cellphone;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @var string
     */
    private $cleansingComment;

    /** @var string */
    private $cleansingInvalidDataReason;

    /**
     * @var Collection|int[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $contentLists;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $country;

    /**
     * @var Collection|array[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $customFields;

    /**
     * @var int
     */
    private $dataPoints;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $descriptionLong;

    /**
     * @var string
     */
    private $descriptionShort;

    /**
     * @var array
     */
    private $doctorComData;

    /**
     * @var string
     * @Assert\Email
     */
    private $email;

    /**
     * @var string
     */
    private $emailVerification;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $features;

    /**
     * @var \DateTime
     */
    private $futureOpeningDate;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $imprint;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $keywords;

    /**
     * @var Collection|Label[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $labels;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $languages;

    /**
     * @var \DateTime
     */
    private $lastSyncStarted;

    /**
     * @var \DateTime
     */
    private $lastUpdated;

    /**
     * @var float
     */
    private $lat;

    /**
     * @var string
     */
    private $legalIdent;

    /**
     * @var Collection|Listing[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $listings;

    /**
     * @var int
     */
    private $listingsBeingUpdated;

    /**
     * @var int
     */
    private $listingsInSync;

    /**
     * @var float
     */
    private $lng;

    /**
     * @var LocationPhoto
     * @Assert\Type("Localfr\UberallBundle\Entity\LocationPhoto")
     */
    private $mainPhoto;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $missingMandatoryFields;

    /**
     * @var Collection|MoreHour[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $moreHours;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     */
    private $nameDescriptor;

    /**
     * @var Collection|OpeningHour[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $openingHours;

    /**
     * @var string
     */
    private $openingHoursNotes;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $paymentOptions;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var Collection|LocationPhoto[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $photos;

    /**
     * @var int
     */
    private $profileCompleteness;

    /**
     * @var string
     */
    private $province;

    /**
     * @var int
     */
    private $publishedListingsCount;

    /**
     * @var Collection|ServiceArea[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $serviceAreas;

    /**
     * @var Collection|Service[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $services;

    /**
     * @var Collection|SocialProfile[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $socialProfiles;

    /**
     * @var Collection|SpecialOpeningHour[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $specialOpeningHours;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $street;

    /**
     * @var string
     */
    private $streetNo;

    /**
     * @var string
     */
    private $streetType;

    /**
     * @var string
     */
    private $taxNumber;

    /**
     * @var array
     * @Assert\Type("array")
     */
    private $updateHistory;

    /**
     * @var Collection|Video[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $videos;

    /**
     * @var int
     */
    private $visibilityIndex;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $websiteExtra;

    /**
     * @var string
     * @Assert\NotBlank
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
        $this->activeDirectoriesCount = $payload['activeDirectoriesCount'] ?? null;
        $this->activeListingsCount = $payload['activeListingsCount'] ?? null;
        $this->addressDisplay = $payload['addressDisplay'] ?? null;
        $this->addressExtra = $payload['addressExtra'] ?? null;

        $this->attributes = null;
        if (array_key_exists('attributes', $payload) && is_array($payload['attributes'] && !empty($payload['attributes']))) {
            foreach ($payload['attributes'] as $attribute) {
                $this->addAttribute($attribute);
            }
        }

        $this->autoSync = $payload['autoSync'] ?? null;
        
        $this->brands = null;
        if (array_key_exists('brands', $payload) && is_array($payload['brands'] && !empty($payload['brands']))) {
            foreach ($payload['brands'] as $brand) {
                $this->addBrand($brand);
            }
        }

        $this->businessId = $payload['businessId'] ?? null;
        
        $this->categories = null;
        if (array_key_exists('categories', $payload) && is_array($payload['categories'] && !empty($payload['categories']))) {
            foreach ($payload['categories'] as $category) {
                $this->addCategory($category);
            }
        }

        $this->cellphone = $payload['cellphone'] ?? null;
        $this->city = $payload['city'] ?? null;
        $this->cleansingComment = $payload['cleansingComment'] ?? null;
        $this->cleansingInvalidDataReason = $payload['cleansingInvalidDataReason'] ?? null;
        
        $this->contentLists = null;
        if (array_key_exists('contentLists', $payload) && is_array($payload['contentLists'] && !empty($payload['contentLists']))) {
            foreach ($payload['contentLists'] as $contentList) {
                $this->addContentList($contentList);
            }
        }

        $this->country = $payload['country'] ?? null;
        
        $this->customFields = null;
        if (array_key_exists('customFields', $payload) && is_array($payload['customFields'] && !empty($payload['customFields']))) {
            foreach ($payload['customFields'] as $customField) {
                $this->addCustomField($customField);
            }
        }

        $this->dataPoints = $payload['dataPoints'] ?? null;
        $this->dateCreated = $payload['dateCreated'] ?? null;
        $this->descriptionLong = $payload['descriptionLong'] ?? null;
        $this->descriptionShort = $payload['descriptionShort'] ?? null;
        $this->doctorComData = $payload['doctorComData'] ?? null;
        $this->email = $payload['email'] ?? null;
        $this->emailVerification = $payload['emailVerification'] ?? null;
        $this->fax = $payload['fax'] ?? null;
        
        $this->features = null;
        if (array_key_exists('features', $payload) && is_array($payload['features'] && !empty($payload['features']))) {
            foreach ($payload['features'] as $feature) {
                $this->addFeature($feature);
            }
        }

        $this->futureOpeningDate = $payload['futureOpeningDate'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->imprint = $payload['imprint'] ?? null;
        
        $this->keywords = null;
        if (array_key_exists('keywords', $payload) && is_array($payload['keywords'] && !empty($payload['keywords']))) {
            foreach ($payload['keywords'] as $keyword) {
                $this->addKeyword($keyword);
            }
        }
        
        $this->labels = null;
        if (array_key_exists('labels', $payload) && is_array($payload['labels'] && !empty($payload['labels']))) {
            foreach ($payload['labels'] as $label) {
                $this->addLabel($label);
            }
        }

        $this->languages = null;
        if (array_key_exists('languages', $payload) && is_array($payload['languages'] && !empty($payload['languages']))) {
            foreach ($payload['languages'] as $language) {
                $this->addLanguage($language);
            }
        }

        $this->lastSyncStarted = $payload['lastSyncStarted'] ?? null;
        $this->lastUpdated = $payload['lastUpdated'] ?? null;
        $this->lat = $payload['lat'] ?? null;
        $this->legalIdent = $payload['legalIdent'] ?? null;

        $this->listings = null;
        if (array_key_exists('listings', $payload) && is_array($payload['listings'] && !empty($payload['listings']))) {
            foreach ($payload['listings'] as $listing) {
                $this->addListing($listing);
            }
        }
        
        $this->listingsBeingUpdated = $payload['listingsBeingUpdated'] ?? null;
        $this->listingsInSync = $payload['listingsInSync'] ?? null;
        $this->lng = $payload['lng'] ?? null;
        $this->mainPhoto = $payload['mainPhoto'] ?? null;
        
        $this->missingMandatoryFields = null;
        if (array_key_exists('missingMandatoryFields', $payload) && is_array($payload['missingMandatoryFields'] && !empty($payload['missingMandatoryFields']))) {
            foreach ($payload['missingMandatoryFields'] as $missingMandatoryField) {
                $this->addMissingMandatoryField($missingMandatoryField);
            }
        }
        
        $this->moreHours = null;
        if (array_key_exists('moreHours', $payload) && is_array($payload['moreHours'] && !empty($payload['moreHours']))) {
            foreach ($payload['moreHours'] as $moreHour) {
                $this->addMoreHour($moreHour);
            }
        }

        $this->name = $payload['name'] ?? null;
        $this->nameDescriptor = $payload['nameDescriptor'] ?? null;
        
        $this->openingHours = null;
        if (array_key_exists('openingHours', $payload) && is_array($payload['openingHours'] && !empty($payload['openingHours']))) {
            foreach ($payload['openingHours'] as $openingHour) {
                $this->addOpeningHour($openingHour);
            }
        }

        $this->openingHoursNotes = $payload['openingHoursNotes'] ?? null;
        
        $this->paymentOptions = null;
        if (array_key_exists('paymentOptions', $payload) && is_array($payload['paymentOptions'] && !empty($payload['paymentOptions']))) {
            foreach ($payload['paymentOptions'] as $paymentOption) {
                $this->addPaymentOption($paymentOption);
            }
        }

        $this->phone = $payload['phone'] ?? null;
        
        $this->photos = null;
        if (array_key_exists('photos', $payload) && is_array($payload['photos'] && !empty($payload['photos']))) {
            foreach ($payload['photos'] as $photo) {
                $this->addPhoto($photo);
            }
        }

        $this->profileCompleteness = $payload['profileCompleteness'] ?? null;
        $this->province = $payload['province'] ?? null;
        $this->publishedListingsCount = $payload['publishedListingsCount'] ?? null;
        
        $this->serviceAreas = null;
        if (array_key_exists('serviceAreas', $payload) && is_array($payload['serviceAreas'] && !empty($payload['serviceAreas']))) {
            foreach ($payload['serviceAreas'] as $serviceArea) {
                $this->addServiceArea($serviceArea);
            }
        }

        $this->services = null;
        if (array_key_exists('services', $payload) && is_array($payload['services'] && !empty($payload['services']))) {
            foreach ($payload['services'] as $service) {
                $this->addService($service);
            }
        }

        $this->socialProfiles = null;
        if (array_key_exists('socialProfiles', $payload) && is_array($payload['socialProfiles'] && !empty($payload['socialProfiles']))) {
            foreach ($payload['socialProfiles'] as $socialProfile) {
                $this->addSocialProfile($socialProfile);
            }
        }

        $this->specialOpeningHours = null;
        if (array_key_exists('specialOpeningHours', $payload) && is_array($payload['specialOpeningHours'] && !empty($payload['specialOpeningHours']))) {
            foreach ($payload['specialOpeningHours'] as $specialOpeningHour) {
                $this->addSpecialOpeningHour($specialOpeningHour);
            }
        }

        $this->status = $payload['status'] ?? null;
        $this->street = $payload['street'] ?? null;
        $this->streetNo = $payload['streetNo'] ?? null;
        $this->streetType = $payload['streetType'] ?? null;
        $this->taxNumber = $payload['taxNumber'] ?? null;
        $this->updateHistory = $payload['updateHistory'] ?? null;
        
        $this->videos = null;
        if (array_key_exists('videos', $payload) && is_array($payload['videos'] && !empty($payload['videos']))) {
            foreach ($payload['videos'] as $video) {
                $this->addVideo($video);
            }
        }

        $this->visibilityIndex = $payload['visibilityIndex'] ?? null;
        $this->website = $payload['website'] ?? null;
        $this->websiteExtra = $payload['websiteExtra'] ?? null;
        $this->zip = $payload['zip'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getActiveDirectoriesCount(): ?int
    {
        return $this->activeDirectoriesCount;
    }

    /**
     * @param int|null $activeDirectoriesCount
     * 
     * @return self
     */
    public function setActiveDirectoriesCount(?int $activeDirectoriesCount): self
    {
        $this->activeDirectoriesCount = $activeDirectoriesCount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getActiveListingsCount(): ?int
    {
        return $this->activeListingsCount;
    }

    /**
     * @param int|null $activeListingsCount
     * 
     * @return self
     */
    public function setActiveListingsCount(?int $activeListingsCount): self
    {
        $this->activeListingsCount = $activeListingsCount;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isAddressDisplay(): ?bool
    {
        return $this->addressDisplay;
    }

    /**
     * @param bool $addressDisplay
     *
     * @return self
     */
    public function setAddressDisplay(bool $addressDisplay): self
    {
        $this->addressDisplay = $addressDisplay;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressExtra(): ?string
    {
        return $this->addressExtra;
    }

    /**
     * @param string|null $addressExtra
     * 
     * @return self
     */
    public function setAddressExtra(?string $addressExtra): self
    {
        $this->addressExtra = $addressExtra;
        return $this;
    }

    /**
     * @return Collection|AttributeWrapper[]|null
     */
    public function getAttributes(): ?Collection
    {
        return $this->attributes;
    }

    /**
     * @param AttributeWrapper $attribute
     *
     * @return self
     */
    public function addAttribute(AttributeWrapper $attribute): self
    {
        if (null === $this->attributes) {
            $this->attributes = new ArrayCollection();
        }

        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
        }
        return $this;
    }

    /**
     * @param AttributeWrapper $attribute
     *
     * @return self
     */
    public function removeAttribute(AttributeWrapper $attribute): self
    {
        if (null === $this->attributes) {
            return $this;
        }

        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isAutoSync(): ?bool
    {
        return $this->autoSync;
    }

    /**
     * @param bool $autoSync
     *
     * @return self
     */
    public function setAutoSync(bool $autoSync): self
    {
        $this->autoSync = $autoSync;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBusinessId(): ?int
    {
        return $this->businessId;
    }

    /**
     * @param int|null $businessId
     * 
     * @return self
     */
    public function setBusinessId(?int $businessId): self
    {
        $this->businessId = $businessId;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getBrands(): ?Collection
    {
        return $this->brands;
    }

    /**
     * @param string $brand
     *
     * @return self
     */
    public function addBrand(string $brand): self
    {
        if (null === $this->brands) {
            $this->brands = new ArrayCollection();
        }

        if (!$this->brands->contains($brand)) {
            $this->brands[] = $brand;
        }
        return $this;
    }

    /**
     * @param string $brand
     *
     * @return self
     */
    public function removeBrand(string $brand): self
    {
        if (null === $this->brands) {
            return $this;
        }

        if ($this->brands->contains($brand)) {
            $this->brands->removeElement($brand);
        }
        return $this;
    }

    /**
     * @return Collection|int[]|null
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param int $categorie
     *
     * @return self
     */
    public function addCategory(int $categorie): self
    {
        if (null === $this->categories) {
            $this->categories = new ArrayCollection();
        }

        if (!$this->categories->contains($categorie)) {
            $this->categories[] = $categorie;
        }
        return $this;
    }

    /**
     * @param int $categorie
     *
     * @return self
     */
    public function removeCategory(int $categorie): self
    {
        if (null === $this->categories) {
            return $this;
        }

        if ($this->categories->contains($categorie)) {
            $this->categories->removeElement($categorie);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    /**
     * @param string|null $cellphone
     * 
     * @return self
     */
    public function setCellphone(?string $cellphone): self
    {
        $this->cellphone = $cellphone;
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
     * @return string|null
     */
    public function getCleansingComment(): ?string
    {
        return $this->cleansingComment;
    }

    /**
     * @param string|null $cleansingComment
     * @return self
     */
    public function setCleansingComment(?string $cleansingComment): self
    {
        $this->cleansingComment = $cleansingComment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCleansingInvalidDataReason(): ?string
    {
        return $this->cleansingInvalidDataReason;
    }

    /**
     * @param string|null $cleansingInvalidDataReason
     * 
     * @return self
     */
    public function setCleansingInvalidDataReason(?string $cleansingInvalidDataReason): self
    {
        $this->cleansingInvalidDataReason = $cleansingInvalidDataReason;
        return $this;
    }

    /**
     * @return Collection|int[]|null
     */
    public function getContentLists(): ?Collection
    {
        return $this->contentLists;
    }

    /**
     * @param int $contentList
     *
     * @return self
     */
    public function addContentList(int $contentList): self
    {
        if (null === $this->contentLists) {
            $this->contentLists = new ArrayCollection();
        }

        if (!$this->contentLists->contains($contentList)) {
            $this->contentLists[] = $contentList;
        }
        return $this;
    }

    /**
     * @param int $contentList
     *
     * @return self
     */
    public function removeContentList(int $contentList): self
    {
        if (null === $this->contentLists) {
            return $this;
        }

        if ($this->contentLists->contains($contentList)) {
            $this->contentLists->removeElement($contentList);
        }
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
     * @return Collection|array[]|null
     */
    public function getCustomFields(): ?Collection
    {
        return $this->customFields;
    }

    /**
     * @param array $customField
     *
     * @return self
     */
    public function addCustomField(array $customField): self
    {
        if (null === $this->customFields) {
            $this->customFields = new ArrayCollection();
        }

        if (!$this->customFields->contains($customField)) {
            $this->customFields[] = $customField;
        }
        return $this;
    }

    /**
     * @param array $customField
     *
     * @return self
     */
    public function removeCustomField(array $customField): self
    {
        if (null === $this->customFields) {
            return $this;
        }

        if ($this->customFields->contains($customField)) {
            $this->customFields->removeElement($customField);
        }
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDatapoints(): ?int
    {
        return $this->dataPoints;
    }

    /**
     * @param int|null $dataPoints
     * 
     * @return Locatselfion
     */
    public function setDatapoints(?int $dataPoints): self
    {
        $this->dataPoints = $dataPoints;
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
    public function getDescriptionLong(): ?string
    {
        return $this->descriptionLong;
    }

    /**
     * @param string|null $descriptionLong
     * 
     * @return self
     */
    public function setDescriptionLong(?string $descriptionLong): self
    {
        $this->descriptionLong = $descriptionLong;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }

    /**
     * @param string|null $descriptionShort
     * 
     * @return self
     */
    public function setDescriptionShort(?string $descriptionShort): self
    {
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getDoctorComData(): ?array
    {
        return $this->doctorComData;
    }

    /**
     * @param array|null $doctorComData
     * 
     * @return self
     */
    public function setDoctorComData(?array $doctorComData): self
    {
        $this->doctorComData = $doctorComData;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * 
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailVerification(): ?string
    {
        return $this->emailVerification;
    }

    /**
     * @param string|null $emailVerification
     * 
     * @return self
     */
    public function setEmailVerification(?string $emailVerification): self
    {
        $this->emailVerification = $emailVerification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * 
     * @return self
     */
    public function setFax(?string $fax): self
    {
        $this->fax = $fax;
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
     * @return \DateTimeInterface|null
     */
    public function getFutureOpeningDate(): ?\DateTimeInterface
    {
        return $this->futureOpeningDate;
    }

    /**
     * @param \DateTimeInterface|string|null $futureOpeningDate
     * 
     * @return self
     */
    public function setFutureOpeningDate($futureOpeningDate = null): self
    {
        if (null !== $futureOpeningDate && !$futureOpeningDate instanceof \DateTimeInterface) {
            $futureOpeningDate = new \DateTime($futureOpeningDate);
        }
        $this->futureOpeningDate = $futureOpeningDate;
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
    public function getImprint(): ?string
    {
        return $this->imprint;
    }

    /**
     * @param string|null $imprint
     * 
     * @return self
     */
    public function setImprint(?string $imprint): self
    {
        $this->imprint = $imprint;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getKeywords(): ?Collection
    {
        return $this->keywords;
    }

    /**
     * @param string $keyword
     *
     * @return self
     */
    public function addKeyword(string $keyword): self
    {
        if (null === $this->keywords) {
            $this->keywords = new ArrayCollection();
        }

        if (!$this->keywords->contains($keyword)) {
            $this->keywords[] = $keyword;
        }
        return $this;
    }

    /**
     * @param string $keyword
     *
     * @return self
     */
    public function removeKeyword(string $keyword): self
    {
        if (null === $this->keywords) {
            return $this;
        }

        if ($this->keywords->contains($keyword)) {
            $this->keywords->removeElement($keyword);
        }
        return $this;
    }
    
    /**
     * @return Collection|Label[]|null
     */
    public function getLabels(): ?Collection
    {
        return $this->labels;
    }

    /**
     * @param Label $label
     *
     * @return self
     */
    public function addLabel(Label $label): self
    {
        if (null === $this->labels) {
            $this->labels = new ArrayCollection();
        }

        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
        }
        return $this;
    }

    /**
     * @param Label $label
     *
     * @return self
     */
    public function removeLabel(Label $label): self
    {
        if (null === $this->labels) {
            return $this;
        }

        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
        }
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getLanguages(): ?Collection
    {
        return $this->languages;
    }

    /**
     * @param string $language
     *
     * @return self
     */
    public function addLanguage(string $language): self
    {
        if (null === $this->languages) {
            $this->languages = new ArrayCollection();
        }

        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
        }
        return $this;
    }

    /**
     * @param string $language
     *
     * @return self
     */
    public function removeLanguage(string $language): self
    {
        if (null === $this->languages) {
            return $this;
        }

        if ($this->languages->contains($language)) {
            $this->languages->removeElement($language);
        }
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastSyncStarted(): ?\DateTimeInterface
    {
        return $this->lastSyncStarted;
    }

    /**
     * @param \DateTimeInterface|string|null $lastSyncStarted
     * 
     * @return self
     */
    public function setLastSyncStarted($lastSyncStarted = null): self
    {
        if (null !== $lastSyncStarted && !$lastSyncStarted instanceof \DateTimeInterface) {
            $lastSyncStarted = new \DateTime($lastSyncStarted);
        }
        $this->lastSyncStarted = $lastSyncStarted;
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
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * 
     * @return self
     */
    public function setLat(?float $lat): self
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLegalIdent(): ?string
    {
        return $this->legalIdent;
    }

    /**
     * @param string|null $legalIdent
     * 
     * @return self
     */
    public function setLegalIdent(?string $legalIdent): self
    {
        $this->legalIdent = $legalIdent;
        return $this;
    }

    /**
     * @return Collection|Listing[]|null
     */
    public function getListings(): ?Collection
    {
        return $this->listings;
    }

    /**
     * @param Listing $listing
     *
     * @return self
     */
    public function addListing(Listing $listing): self
    {
        if (null === $this->listings) {
            $this->listings = new ArrayCollection();
        }

        if (!$this->listings->contains($listing)) {
            $this->listings[] = $listing;
        }
        return $this;
    }

    /**
     * @param Listing $listing
     *
     * @return self
     */
    public function removeListing(Listing $listing): self
    {
        if (null === $this->listings) {
            return $this;
        }

        if ($this->listings->contains($listing)) {
            $this->listings->removeElement($listing);
        }
        return $this;
    }

    /**
     * @return int|null
     */
    public function getListingsBeingUpdated(): ?int
    {
        return $this->listingsBeingUpdated;
    }

    /**
     * @param int|null $listingsBeingUpdated
     * 
     * @return self
     */
    public function setListingsBeingUpdated(?int $listingsBeingUpdated): self
    {
        $this->listingsBeingUpdated = $listingsBeingUpdated;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getListingsInSync(): ?int
    {
        return $this->listingsInSync;
    }

    /**
     * @param int|null $listingsInSync
     * 
     * @return self
     */
    public function setListingsInSync(?int $listingsInSync): self
    {
        $this->listingsInSync = $listingsInSync;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     * 
     * @return self
     */
    public function setLng(?float $lng): self
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @return LocationPhoto|null
     */
    public function getMainPhoto(): ?LocationPhoto
    {
        return $this->mainPhoto;
    }

    /**
     * @param LocationPhoto|null $mainPhoto
     * 
     * @return self
     */
    public function setMainPhoto(?LocationPhoto $mainPhoto): self
    {
        $this->mainPhoto = $mainPhoto;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getMissingMandatoryFields(): ?Collection
    {
        return $this->missingMandatoryFields;
    }

    /**
     * @param string $missingMandatoryField
     *
     * @return self
     */
    public function addMissingMandatoryField(string $missingMandatoryField): self
    {
        if (null === $this->missingMandatoryFields) {
            $this->missingMandatoryFields = new ArrayCollection();
        }

        if (!$this->missingMandatoryFields->contains($missingMandatoryField)) {
            $this->missingMandatoryFields[] = $missingMandatoryField;
        }
        return $this;
    }

    /**
     * @param string $missingMandatoryField
     *
     * @return self
     */
    public function removeMissingMandatoryField(string $missingMandatoryField): self
    {
        if (null === $this->missingMandatoryFields) {
            return $this;
        }

        if ($this->missingMandatoryFields->contains($missingMandatoryField)) {
            $this->missingMandatoryFields->removeElement($missingMandatoryField);
        }
        return $this;
    }

    /**
     * @return Collection|MoreHour[]|null
     */
    public function getMoreHours(): ?Collection
    {
        return $this->moreHours;
    }

    /**
     * @param MoreHour $moreHour
     *
     * @return self
     */
    public function addMoreHour(MoreHour $moreHour): self
    {
        if (null === $this->moreHours) {
            $this->moreHours = new ArrayCollection();
        }

        if (!$this->moreHours->contains($moreHour)) {
            $this->moreHours[] = $moreHour;
        }
        return $this;
    }

    /**
     * @param MoreHour $moreHour
     *
     * @return self
     */
    public function removeMoreHour(MoreHour $moreHour): self
    {
        if (null === $this->moreHours) {
            return $this;
        }

        if ($this->moreHours->contains($moreHour)) {
            $this->moreHours->removeElement($moreHour);
        }
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
    public function getNameDescriptor(): ?string
    {
        return $this->nameDescriptor;
    }

    /**
     * @param string|null $nameDescriptor
     * 
     * @return self
     */
    public function setNameDescriptor(?string $nameDescriptor): self
    {
        $this->nameDescriptor = $nameDescriptor;
        return $this;
    }

    /**
     * @return Collection|OpeningHour[|null
     */
    public function getOpeningHours(): ?Collection
    {
        return $this->openingHours;
    }

    /**
     * @param OpeningHour $openingHour
     *
     * @return self
     */
    public function addOpeningHour(OpeningHour $openingHour): self
    {
        if (null === $this->openingHours) {
            $this->openingHours = new ArrayCollection();
        }

        if (!$this->openingHours->contains($openingHour)) {
            $this->openingHours[] = $openingHour;
        }
        return $this;
    }

    /**
     * @param OpeningHour $openingHour
     *
     * @return self
     */
    public function removeOpeningHour(OpeningHour $openingHour): self
    {
        if (null === $this->openingHours) {
            return $this;
        }

        if ($this->openingHours->contains($openingHour)) {
            $this->openingHours->removeElement($openingHour);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOpeningHoursNotes(): ?string
    {
        return $this->openingHoursNotes;
    }

    /**
     * @param string|null $openingHoursNotes
     * 
     * @return self
     */
    public function setOpeningHoursNotes(?string $openingHoursNotes): self
    {
        $this->openingHoursNotes = $openingHoursNotes;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getPaymentOptions(): ?Collection
    {
        return $this->paymentOptions;
    }

    /**
     * @param string $paymentOption
     *
     * @return self
     */
    public function addPaymentOption(string $paymentOption): self
    {
        if (null === $this->paymentOptions) {
            $this->paymentOptions = new ArrayCollection();
        }

        if (!$this->paymentOptions->contains($paymentOption)) {
            $this->paymentOptions[] = $paymentOption;
        }
        return $this;
    }

    /**
     * @param string $paymentOption
     *
     * @return self
     */
    public function removePaymentOption(string $paymentOption): self
    {
        if (null === $this->paymentOptions) {
            return $this;
        }

        if ($this->paymentOptions->contains($paymentOption)) {
            $this->paymentOptions->removeElement($paymentOption);
        }
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
     * @return Collection|LocationPhoto[]|null
     */
    public function getPhotos(): ?Collection
    {
        return $this->photos;
    }

    /**
     * @param LocationPhoto $photo
     *
     * @return self
     */
    public function addPhoto(LocationPhoto $photo): self
    {
        if (null === $this->photos) {
            $this->photos = new ArrayCollection();
        }

        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
        }
        return $this;
    }

    /**
     * @param LocationPhoto $photo
     *
     * @return self
     */
    public function removePhoto(LocationPhoto $photo): self
    {
        if (null === $this->photos) {
            return $this;
        }

        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
        }
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProfileCompleteness(): ?int
    {
        return $this->profileCompleteness;
    }

    /**
     * @param int|null $profileCompleteness
     * 
     * @return self
     */
    public function setProfileCompleteness(?int $profileCompleteness): self
    {
        $this->profileCompleteness = $profileCompleteness;
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
     * @return int|null
     */
    public function getPublishedListingsCount(): ?int
    {
        return $this->publishedListingsCount;
    }

    /**
     * @param int|null $publishedListingsCount
     * 
     * @return self
     */
    public function setPublishedListingsCount(?int $publishedListingsCount): self
    {
        $this->publishedListingsCount = $publishedListingsCount;
        return $this;
    }

    /**
     * @return Collection|ServiceArea[]|null
     */
    public function getServiceAreas(): ?Collection
    {
        return $this->serviceAreas;
    }

    /**
     * @param ServiceArea $serviceArea
     *
     * @return self
     */
    public function addServiceArea(ServiceArea $serviceArea): self
    {
        if (null === $this->serviceAreas) {
            $this->serviceAreas = new ArrayCollection();
        }

        if (!$this->serviceAreas->contains($serviceArea)) {
            $this->serviceAreas[] = $serviceArea;
        }
        return $this;
    }

    /**
     * @param ServiceArea $serviceArea
     *
     * @return self
     */
    public function removeServiceArea(ServiceArea $serviceArea): self
    {
        if (null === $this->serviceAreas) {
            return $this;
        }

        if ($this->serviceAreas->contains($serviceArea)) {
            $this->serviceAreas->removeElement($serviceArea);
        }
        return $this;
    }

    /**
     * @return Collection|Service[]|null
     */
    public function getServices(): ?Collection
    {
        return $this->services;
    }

    /**
     * @param Service $service
     *
     * @return self
     */
    public function addService(Service $service): self
    {
        if (null === $this->services) {
            $this->services = new ArrayCollection();
        }

        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }
        return $this;
    }

    /**
     * @param Service $service
     *
     * @return self
     */
    public function removeService(Service $service): self
    {
        if (null === $this->services) {
            return $this;
        }

        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
        }
        return $this;
    }

    /**
     * @return Collection|SocialProfile[]|null
     */
    public function getSocialProfiles(): ?Collection
    {
        return $this->socialProfiles;
    }

    /**
     * @param SocialProfile $socialProfile
     *
     * @return self
     */
    public function addSocialProfile(SocialProfile $socialProfile): self
    {
        if (null === $this->socialProfiles) {
            $this->socialProfiles = new ArrayCollection();
        }

        if (!$this->socialProfiles->contains($socialProfile)) {
            $this->socialProfiles[] = $socialProfile;
        }
        return $this;
    }

    /**
     * @param SocialProfile $socialProfile
     *
     * @return self
     */
    public function removeSocialProfile(SocialProfile $socialProfile): self
    {
        if (null === $this->socialProfiles) {
            return $this;
        }

        if ($this->socialProfiles->contains($socialProfile)) {
            $this->socialProfiles->removeElement($socialProfile);
        }
        return $this;
    }

    /**
     * @return Collection|SpecialOpeningHour[]|null
     */
    public function getSpecialOpeningHours(): ?Collection
    {
        return $this->specialOpeningHours;
    }

    /**
     * @param SpecialOpeningHour $specialOpeningHour
     *
     * @return self
     */
    public function addSpecialOpeningHour(SpecialOpeningHour $specialOpeningHour): self
    {
        if (null === $this->specialOpeningHours) {
            $this->specialOpeningHours = new ArrayCollection();
        }

        if (!$this->specialOpeningHours->contains($specialOpeningHour)) {
            $this->specialOpeningHours[] = $specialOpeningHour;
        }
        return $this;
    }

    /**
     * @param SpecialOpeningHour $specialOpeningHour
     *
     * @return self
     */
    public function removeSpecialOpeningHour(SpecialOpeningHour $specialOpeningHour): self
    {
        if (null === $this->specialOpeningHours) {
            return $this;
        }

        if ($this->specialOpeningHours->contains($specialOpeningHour)) {
            $this->specialOpeningHours->removeElement($specialOpeningHour);
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
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * 
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetNo(): ?string
    {
        return $this->streetNo;
    }

    /**
     * @param string|null $streetNo
     * 
     * @return self
     */
    public function setStreetNo(?string $streetNo): self
    {
        $this->streetNo = $streetNo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetType(): ?string
    {
        return $this->streetType;
    }

    /**
     * @param string|null $streetType
     * 
     * @return self
     */
    public function setStreetType(?string $streetType): self
    {
        $this->streetType = $streetType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    /**
     * @param string|null $taxNumber
     * 
     * @return self
     */
    public function setTaxNumber(?string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getUpdateHistory(): ?array
    {
        return $this->updateHistory;
    }

    /**
     * @param array|null $updateHistory
     *
     * @return self
     */
    public function setUpdateHistory(?array $updateHistory = null): self
    {
        $this->updateHistory = $updateHistory;
        return $this;
    }

    /**
     * @return Collection|Video[]|null
     */
    public function getVideos(): ?Collection
    {
        return $this->videos;
    }

    /**
     * @param Video $video
     *
     * @return self
     */
    public function addVideo(Video $video): self
    {
        if (null === $this->videos) {
            $this->videos = new ArrayCollection();
        }

        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
        }
        return $this;
    }

    /**
     * @param Video $video
     *
     * @return self
     */
    public function removeVideo(Video $video): self
    {
        if (null === $this->videos) {
            return $this;
        }

        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
        }
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVisibilityIndex(): ?int
    {
        return $this->visibilityIndex;
    }

    /**
     * @param int|null $visibilityIndex
     * 
     * @return self
     */
    public function setVisibilityIndex(?int $visibilityIndex): self
    {
        $this->visibilityIndex = $visibilityIndex;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * 
     * @return self
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsiteExtra(): ?string
    {
        return $this->websiteExtra;
    }

    /**
     * @param string|null $websiteExtra
     * 
     * @return self
     */
    public function setWebsiteExtra(?string $websiteExtra): self
    {
        $this->websiteExtra = $websiteExtra;
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
