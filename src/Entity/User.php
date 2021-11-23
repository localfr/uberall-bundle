<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;

class User extends UberallEntityBase
{
    const SALUTATION = [
        'FEMALE', 'MALE', 'OTHER'
    ];

    const USER_ROLE = [
        'ACCOUNT_MANAGER', 'ADMIN',
        'BUSINESS_MANAGER', 'LOCATION_MANAGER'
    ];

    const USER_STATUS = [
        'CREATED', 'INACTIVE', 'INVITED',
        'NO_LOGIN', 'UNVERIFIED', 'VERIFIED'
    ];

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var Collection|EmailSetting[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $emailSettings;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $features;

    /**
     * @var Collection|array[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $featuresDetailed;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $firstname;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $lastname;

    /**
     * @var Collection|Business[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $managedBusinesses;

    /**
     * @var Collection|Location[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $managedLocations;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $preferredLanguage;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Choice(choices=User::USER_ROLE)
     */
    private $role;

    /**
     * @var SalesPartner
     */
    private $salesPartner;

    /**
     * @var string
     * @Assert\Choice(choices=User::USER_STATUS)
     */
    private $status;

    /**
     * @var string
     */
    private $whitelabelInformationIdentifier;

    /**
     * @var string
     * @Assert\Choice(choices=User::SALUTATION)
     */
    private $salutation;

    /**
     * Label constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->email = $payload['email'] ?? null;
        
        $this->emailSettings = null;
        if (array_key_exists('emailSettings', $payload) && is_array($payload['emailSettings'] && !empty($payload['emailSettings']))) {
            foreach ($payload['emailSettings'] as $emailSetting) {
                $this->addEmailSetting($emailSetting);
            }
        }

        $this->features = null;
        if (array_key_exists('features', $payload) && is_array($payload['features'] && !empty($payload['features']))) {
            foreach ($payload['features'] as $feature) {
                $this->addEmailSetting($feature);
            }
        }

        $this->featuresDetailed = null;
        if (array_key_exists('featuresDetailed', $payload) && is_array($payload['featuresDetailed'] && !empty($payload['featuresDetailed']))) {
            foreach ($payload['featuresDetailed'] as $featureDetailed) {
                $this->addEmailSetting($featureDetailed);
            }
        }

        $this->firstname = $payload['firstname'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->lastname = $payload['lastname'] ?? null;

        $this->managedBusinesses = null;
        if (array_key_exists('managedBusinesses', $payload) && is_array($payload['managedBusinesses'] && !empty($payload['managedBusinesses']))) {
            foreach ($payload['managedBusinesses'] as $managedBusiness) {
                $this->addEmailSetting($managedBusiness);
            }
        }

        $this->managedLocations = null;
        if (array_key_exists('managedLocations', $payload) && is_array($payload['managedLocations'] && !empty($payload['managedLocations']))) {
            foreach ($payload['managedLocations'] as $managedLocation) {
                $this->addEmailSetting($managedLocation);
            }
        }

        $this->password = $payload['password'] ?? null;
        $this->phone = $payload['phone'] ?? null;
        $this->preferredLanguage = $payload['preferredLanguage'] ?? null;
        $this->role = $payload['role'] ?? null;
        $this->salesPartner = $payload['salesPartner'] ?? null;
        $this->salutation = $payload['salutation'] ?? null;
        $this->status = $payload['status'] ?? null;
        $this->whitelabelInformationIdentifier = $payload['whitelabelInformationIdentifier'] ?? null;
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
     * @return Collection|EmailSetting[]|null
     */
    public function getEmailSettings(): ?Collection
    {
        return $this->emailSettings;
    }

    /**
     * @param EmailSetting $emailSetting
     *
     * @return self
     */
    public function addEmailSetting(EmailSetting $emailSetting): self
    {
        if (null === $this->emailSettings) {
            $this->emailSettings = new ArrayCollection();
        }

        if (!$this->emailSettings->contains($emailSetting)) {
            $this->emailSettings[] = $emailSetting;
        }
        return $this;
    }

    /**
     * @param EmailSetting $emailSetting
     *
     * @return self
     */
    public function removeEmailSetting(EmailSetting $emailSetting): self
    {
        if (null === $this->emailSettings) {
            return $this;
        }

        if ($this->emailSettings->contains($emailSetting)) {
            $this->emailSettings->removeElement($emailSetting);
        }
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
     * @return Collection|array[]|null
     */
    public function getFeaturesDetailed(): ?Collection
    {
        return $this->featuresDetailed;
    }

    /**
     * @param array $featureDetailed
     *
     * @return self
     */
    public function addFeaturesDetailed(array $featureDetailed): self
    {
        if (null === $this->featuresDetailed) {
            $this->featuresDetailed = new ArrayCollection();
        }

        if (!$this->featuresDetailed->contains($featureDetailed)) {
            $this->featuresDetailed[] = $featureDetailed;
        }
        return $this;
    }

    /**
     * @param array $featureDetailed
     *
     * @return self
     */
    public function removeFeaturesDetailed(array $featureDetailed): self
    {
        if (null === $this->featuresDetailed) {
            return $this;
        }

        if ($this->featuresDetailed->contains($featureDetailed)) {
            $this->featuresDetailed->removeElement($featureDetailed);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * 
     * @return self
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;
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
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * 
     * @return self
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return Collection|Business[]|null
     */
    public function getManagedBusinesses(): ?Collection
    {
        return $this->managedBusinesses;
    }

    /**
     * @param Business $managedBusiness
     *
     * @return self
     */
    public function addManagedBusiness(Business $managedBusiness): self
    {
        if (null === $this->managedBusinesses) {
            $this->managedBusinesses = new ArrayCollection();
        }

        if (!$this->managedBusinesses->contains($managedBusiness)) {
            $this->managedBusinesses[] = $managedBusiness;
        }
        return $this;
    }

    /**
     * @param Business $managedBusiness
     *
     * @return self
     */
    public function removeManagedBusiness(Business $managedBusiness): self
    {
        if (null === $this->managedBusinesses) {
            return $this;
        }

        if ($this->managedBusinesses->contains($managedBusiness)) {
            $this->managedBusinesses->removeElement($managedBusiness);
        }
        return $this;
    }

    /**
     * @return Collection|Location[]|null
     */
    public function getManagedLocations(): ?Collection
    {
        return $this->managedLocations;
    }

    /**
     * @param Location $managedLocation
     *
     * @return self
     */
    public function addManagedLocation(Location $managedLocation): self
    {
        if (null === $this->managedLocations) {
            $this->managedLocations = new ArrayCollection();
        }

        if (!$this->managedLocations->contains($managedLocation)) {
            $this->managedLocations[] = $managedLocation;
        }
        return $this;
    }

    /**
     * @param Location $managedLocation
     *
     * @return self
     */
    public function removeManagedLocation(Location $managedLocation): self
    {
        if (null === $this->managedLocations) {
            return $this;
        }

        if ($this->managedLocations->contains($managedLocation)) {
            $this->managedLocations->removeElement($managedLocation);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * 
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;
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
     * @return string|null
     */
    public function getPreferredLanguage(): ?string
    {
        return $this->preferredLanguage;
    }

    /**
     * @param string|null $preferredLanguage
     * 
     * @return self
     */
    public function setPreferredLanguage(?string $preferredLanguage): self
    {
        $this->preferredLanguage = $preferredLanguage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     * 
     * @return self
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return SalesPartner|null
     */
    public function getSalesPartner(): ?SalesPartner
    {
        return $this->salesPartner;
    }

    /**
     * @param SalesPartner|null $salesPartner
     * 
     * @return self
     */
    public function setSalesPartner(?SalesPartner $salesPartner): self
    {
        $this->salesPartner = $salesPartner;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    /**
     * @param string|null $salutation
     * 
     * @return self
     */
    public function setSalutation(?string $salutation): self
    {
        $this->salutation = $salutation;
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
    public function getWhitelabelInformationIdentifier(): ?string
    {
        return $this->whitelabelInformationIdentifier;
    }

    /**
     * @param string|null $whitelabelInformationIdentifier
     * 
     * @return self
     */
    public function setWhitelabelInformationIdentifier(?string $whitelabelInformationIdentifier): self
    {
        $this->whitelabelInformationIdentifier = $whitelabelInformationIdentifier;
        return $this;
    }
}
