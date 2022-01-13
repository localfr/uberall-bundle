<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;

class SalesPartner
{
    const STATUS = [
        'APPROVED', 'CREATED', 'DECLINED',
        'DELETED', 'INACTIVE'
    ];

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    private $aggregateInvoicesToParent;

    /**
     * @var Attribution
     * @Assert\Type("Localfr\UberallBundle\Entity\Attribution")
     */
    private $attribution;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    private $canSeePrices;

    /**
     * @var int
     * @Assert\Positive
     */
    private $contactPerson;

    /**
     * @var string
     * @Assert\Email
     */
    private $emailCustomerSupport;

    /**
     * @var string
     * @Assert\Email
     */
    private $emailProjectLead;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var int
     * @Assert\Positive
     */
    private $minPasswordLength;

    /**
     * @var string
     */
    private $name;

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
     * @Assert\Url
     */
    private $pushUrl;

    /**
     * @var string
     */
    private $resellerType;

    /**
     * @var string
     * @Assert\Choice(choices=SalesPartner::STATUS)
     */
    private $salesPartnerStatus;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $subscribedWebhookEventTypes;

    /**
     * @var string
     * @Assert\Choice(choices={"CUSTOM", "STANDARD"})
     */
    private $type;

    /**
     * @var Collection|WhitelabelInformation[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $whitelabelInformation;

    /**
     * @var Collection|string[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $whitelistedRedirectUrls;

    /**
     * SalesPartner constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->aggregateInvoicesToParent = $payload['aggregateInvoicesToParent'] ?? null;
        $this->attribution = $payload['attribution'] ?? null;
        $this->canSeePrices = $payload['canSeePrices'] ?? null;
        $this->contactPerson = $payload['contactPerson'] ?? null;
        $this->emailCustomerSupport = $payload['emailCustomerSupport'] ?? null;
        $this->emailProjectLead = $payload['emailProjectLead'] ?? null;
        $this->identifier = $payload['identifier'] ?? null;
        $this->minPasswordLength = $payload['minPasswordLength'] ?? null;
        $this->name = $payload['name'] ?? null;
        $this->phone = $payload['phone'] ?? null;
        $this->preferredLanguage = $payload['preferredLanguage'] ?? null;
        $this->pushUrl = $payload['pushUrl'] ?? null;
        $this->resellerType = $payload['resellerType'] ?? null;
        $this->salesPartnerStatus = $payload['salesPartnerStatus'] ?? null;

        $this->subscribedWebhookEventTypes = null;
        if (array_key_exists('subscribedWebhookEventTypes', $payload) && is_array($payload['subscribedWebhookEventTypes'] && !empty($payload['subscribedWebhookEventTypes']))) {
            foreach ($payload['subscribedWebhookEventTypes'] as $subscribedWebhookEventType) {
                $this->addSubscribedWebhookEventType($subscribedWebhookEventType);
            }
        }

        $this->type = $payload['type'] ?? null;

        $this->whitelabelInformation = null;
        if (array_key_exists('whitelabelInformation', $payload) && is_array($payload['whitelabelInformation'] && !empty($payload['whitelabelInformation']))) {
            foreach ($payload['whitelabelInformation'] as $whitelabelInformation) {
                $this->addWhitelabelInformation($whitelabelInformation);
            }
        }

        $this->whitelistedRedirectUrls = null;
        if (array_key_exists('whitelistedRedirectUrls', $payload) && is_array($payload['whitelistedRedirectUrls'] && !empty($payload['whitelistedRedirectUrls']))) {
            foreach ($payload['whitelistedRedirectUrls'] as $whitelistedRedirectUrl) {
                $this->addWhitelistedRedirectUrl($whitelistedRedirectUrl);
            }
        }
    }

    /**
     * @return bool|null
     */
    public function hasAggregateInvoicesToParent(): ?bool
    {
        return $this->aggregateInvoicesToParent;
    }

    /**
     * @param bool|null $aggregateInvoicesToParent
     * 
     * @return self
     */
    public function setAggregateInvoicesToParent(?bool $aggregateInvoicesToParent): self
    {
        $this->aggregateInvoicesToParent = $aggregateInvoicesToParent;
        return $this;
    }

    /**
     * @return Attribution|null
     */
    public function getAttribution(): ?Attribution
    {
        return $this->attribution;
    }

    /**
     * @param Attribution|null $attribution
     * 
     * @return self
     */
    public function setAttribution(?Attribution $attribution): self
    {
        $this->attribution = $attribution;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanSeePrices(): ?bool
    {
        return $this->canSeePrices;
    }

    /**
     * @param bool|null $canSeePrices
     * 
     * @return self
     */
    public function setCanSeePrices(?bool $canSeePrices): self
    {
        $this->canSeePrices = $canSeePrices;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getContactPerson(): ?int
    {
        return $this->contactPerson;
    }

    /**
     * @param int|null $contactPerson
     * 
     * @return self
     */
    public function setContactPerson(?int $contactPerson): self
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCustomerSupport(): ?string
    {
        return $this->emailCustomerSupport;
    }

    /**
     * @param string|null $emailCustomerSupport
     * 
     * @return self
     */
    public function setEmailCustomerSupport(?string $emailCustomerSupport): self
    {
        $this->emailCustomerSupport = $emailCustomerSupport;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailProjectLead(): ?string
    {
        return $this->emailProjectLead;
    }

    /**
     * @param string|null $emailProjectLead
     * 
     * @return self
     */
    public function setEmailProjectLead(?string $emailProjectLead): self
    {
        $this->emailProjectLead = $emailProjectLead;
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
    public function getMinPasswordLength(): ?int
    {
        return $this->minPasswordLength;
    }

    /**
     * @param int|null $minPasswordLength
     * 
     * @return self
     */
    public function setMinPasswordLength(?int $minPasswordLength): self
    {
        $this->minPasswordLength = $minPasswordLength;
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
    public function getPushUrl(): ?string
    {
        return $this->pushUrl;
    }

    /**
     * @param string|null $pushUrl
     * 
     * @return self
     */
    public function setPushUrl(?string $pushUrl): self
    {
        $this->pushUrl = $pushUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getResellerType(): ?string
    {
        return $this->resellerType;
    }

    /**
     * @param string|null $resellerType
     * 
     * @return self
     */
    public function setResellerType(?string $resellerType): self
    {
        $this->resellerType = $resellerType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalesPartnerStatus(): ?string
    {
        return $this->salesPartnerStatus;
    }

    /**
     * @param string|null $salesPartnerStatus
     * 
     * @return self
     */
    public function setStatus(?string $salesPartnerStatus): self
    {
        $this->salesPartnerStatus = $salesPartnerStatus;
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getSubscribedWebhookEventTypes(): ?Collection
    {
        return $this->subscribedWebhookEventTypes;
    }

    /**
     * @param string $subscribedWebhookEventType
     *
     * @return self
     */
    public function addSubscribedWebhookEventType(string $subscribedWebhookEventType): self
    {
        if (null === $this->subscribedWebhookEventTypes) {
            $this->subscribedWebhookEventTypes = new ArrayCollection();
        }

        if (!$this->subscribedWebhookEventTypes->contains($subscribedWebhookEventType)) {
            $this->subscribedWebhookEventTypes[] = $subscribedWebhookEventType;
        }
        return $this;
    }

    /**
     * @param string $subscribedWebhookEventType
     *
     * @return self
     */
    public function removeSubscribedWebhookEventType(string $subscribedWebhookEventType): self
    {
        if (null === $this->subscribedWebhookEventTypes) {
            return $this;
        }

        if ($this->subscribedWebhookEventTypes->contains($subscribedWebhookEventType)) {
            $this->subscribedWebhookEventTypes->removeElement($subscribedWebhookEventType);
        }
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
     * @return Collection|WhitelabelInformation[]|null
     */
    public function getWhitelabelInformation(): ?Collection
    {
        return $this->whitelabelInformation;
    }

    /**
     * @param WhitelabelInformation $whitelabelInformation
     *
     * @return self
     */
    public function addWhitelabelInformation(WhitelabelInformation $whitelabelInformation): self
    {
        if (null === $this->whitelabelInformation) {
            $this->whitelabelInformation = new ArrayCollection();
        }

        if (!$this->whitelabelInformation->contains($whitelabelInformation)) {
            $this->whitelabelInformation[] = $whitelabelInformation;
        }
        return $this;
    }

    /**
     * @param WhitelabelInformation $whitelabelInformation
     *
     * @return self
     */
    public function removeWhitelabelInformation(WhitelabelInformation $whitelabelInformation): self
    {
        if (null === $this->whitelabelInformation) {
            return $this;
        }

        if ($this->whitelabelInformation->contains($whitelabelInformation)) {
            $this->whitelabelInformation->removeElement($whitelabelInformation);
        }
        return $this;
    }

    /**
     * @return Collection|string[]|null
     */
    public function getWhitelistedRedirectUrls(): ?Collection
    {
        return $this->whitelistedRedirectUrls;
    }

    /**
     * @param string $whitelistedRedirectUrl
     *
     * @return self
     */
    public function addWhitelistedRedirectUrl(string $whitelistedRedirectUrl): self
    {
        if (null === $this->whitelistedRedirectUrls) {
            $this->whitelistedRedirectUrls = new ArrayCollection();
        }

        if (!$this->whitelistedRedirectUrls->contains($whitelistedRedirectUrl)) {
            $this->whitelistedRedirectUrls[] = $whitelistedRedirectUrl;
        }
        return $this;
    }

    /**
     * @param string $whitelistedRedirectUrl
     *
     * @return self
     */
    public function removeWhitelistedRedirectUrl(string $whitelistedRedirectUrl): self
    {
        if (null === $this->whitelistedRedirectUrls) {
            return $this;
        }

        if ($this->whitelistedRedirectUrls->contains($whitelistedRedirectUrl)) {
            $this->whitelistedRedirectUrls->removeElement($whitelistedRedirectUrl);
        }
        return $this;
    }
}
