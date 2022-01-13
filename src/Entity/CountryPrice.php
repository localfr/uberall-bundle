<?php

namespace Localfr\UberallBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class CountryPrice
{
    /**
     * @var int
     * @Assert\NotBlank
     */
    private $dayOfWeek;

    /**
     * Hour constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->dayOfWeek = $payload['dayOfWeek'] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * 
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }

    /**
     * @param string $name
     * 
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    /**
     * @return int|null
     */
    public function getDayOfWeek(): ?int
    {
        return $this->dayOfWeek;
    }

    /**
     * @param int|null $dayOfWeek
     * 
     * @return Hour
     */
    public function setDayOfWeek(?int $dayOfWeek): self
    {
        $this->dayOfWeek = $dayOfWeek;
        return $this;
    }
}
