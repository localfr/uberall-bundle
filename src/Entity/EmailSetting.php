<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class EmailSetting
{
    const EMAIL_TYPE = [
        'DIGEST', 'ACTIVATION', 'START_VERIFICATION_GOOGLE', 'FINISH_VERIFICATION_GOOGLE',
        'UNREAD_REVIEW_NOTIFICATION', 'PENDING_APPROVAL_REPLY_NOTIFICATION'
    ];

    const FREQUENCY = [
        'ALWAYS', 'DAILY', 'MONTHLY', 'NEVER', 'WEEKLY'
    ];

    /**
     * @var string
     * @Assert\Choice(choices=EmailSetting::EMAIL_TYPE)
     */
    private $emailType;

    /**
     * @var string
     * @Assert\Choice(choices=EmailSetting::FREQUENCY)
     */
    private $frequency;

    /**
     * Label constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->emailType = $payload['emailType'] ?? null;
        $this->frequency = $payload['frequency'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getEmailType(): ?string
    {
        return $this->emailType;
    }

    /**
     * @param string|null $emailType
     * 
     * @return self
     */
    public function setEmailType(?string $emailType): self
    {
        $this->emailType = $emailType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    /**
     * @param string|null $frequency
     * 
     * @return self
     */
    public function setFrequency(?string $frequency): self
    {
        $this->frequency = $frequency;
        return $this;
    }
}
