<?php

namespace Localfr\UberallBundle\Entity;


class SpecialOpeningHour extends OpeningHour
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * SpecialOpeningHour constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        parent::__construct($payload);
        $this->date = $payload['date'] ?? null;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface|string|null $date
     * 
     * @return SpecialOpeningHour
     */
    public function setDate(?\DateTimeInterface $date): self
    {
        if (null !== $date && !$date instanceof \DateTimeInterface) {
            $date = new \DateTime($date);
        }
        $this->date = $date;
        return $this;
    }
}
