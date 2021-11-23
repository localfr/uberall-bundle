<?php

namespace Localfr\UberallBundle\Exception;

use Throwable;

class BaseException extends \Exception
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(string $message = "", int $code = 0, ?array $data = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data ?: null;
    }

    /**
     * @return array
     */
    final public function getData(): array
    {
        return $this->data;
    }
}
