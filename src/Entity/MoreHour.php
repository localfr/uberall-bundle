<?php

namespace Localfr\UberallBundle\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Symfony\Component\Validator\Constraints as Assert;


class MoreHour
{
    /**
     * @var Collection|Hour[]
     * @Assert\Type("Doctrine\Common\Collections\ArrayCollection")
     */
    private $hours;

    /**
     * MoreHour constructor
     * 
     * @param array|null $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->hours = null;
        if (array_key_exists('hours', $payload) && is_array($payload['hours'] && !empty($payload['hours']))) {
            foreach ($payload['hours'] as $hour) {
                $this->addHour($hour);
            }
        }
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
     * @return Collection|Hour[]|null
     */
    public function getHours(): ?Collection
    {
        return $this->hours;
    }

    /**
     * @param Hour $hour
     *
     * @return self
     */
    public function addHour(Hour $hour): self
    {
        if (null === $this->hours) {
            $this->hours = new ArrayCollection();
        }

        if (!$this->hours->contains($hour)) {
            $this->hours[] = $hour;
        }
        return $this;
    }

    /**
     * @param Hour $hour
     *
     * @return self
     */
    public function removeHour(Hour $hour): self
    {
        if (null === $this->hours) {
            return $this;
        }

        if ($this->hours->contains($hour)) {
            $this->hours->removeElement($hour);
        }
        return $this;
    }
}
