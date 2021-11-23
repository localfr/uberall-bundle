<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;


trait UberallSearchResponseTrait
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $max;

    /**
     * @var int
     */
    private $count;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * 
     * @return self
     */
    public function setOffset(?int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * 
     * @return self
     */
    public function setMax(?int $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * 
     * @return self
     */
    public function setCount(?int $count): self
    {
        $this->count = $count;
        return $this;
    }
}