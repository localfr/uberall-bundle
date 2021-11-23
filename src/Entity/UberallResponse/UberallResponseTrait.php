<?php

namespace Localfr\UberallBundle\Entity\UberallResponse;


trait UberallResponseTrait
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var mixed
     */
    protected $response;

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
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * 
     * @return self
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * 
     * @return self
     */
    public function setResponse($response): self
    {
        $this->response = $response;
        return $this;
    }
}