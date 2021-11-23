<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;


interface UberallResponseInterface
{
    /**
     * @return mixed
     */
    public function getResponse(): mixed;

    /**
     * @param mixed $response
     * 
     * @return self
     */
    public function setResponse(mixed $response = null): self;
}