<?php

namespace Localfr\UberallBundle\Provider;

abstract class UberallProvider implements \ArrayAccess
{
    protected $fieldNames = [];
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fieldNames = $this->getFieldNames();
        $this->setData($data);
    }

    /**
     * @return array
     */
    abstract protected function getFieldNames(): array;

    /**
     * @param mixed $offset
     * @return bool
     * @throws \OutOfBoundsException
     */
    public function offsetExists($offset)
    {
        if (in_array($offset, $this->fieldNames)) {
            return true;
        }

        throw new \OutOfBoundsException("The offset {$offset} does not exist.");
    }

    /**
     * @param string $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data[$offset] ?? null;
        }
    }

    /**
     * @param string $offset
     * @param mixed $value
     * @return self
     */
    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $this->data[$offset] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $offset
     * @return self
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }

        return $this;
    }

    /**
     * @param string $offset
     * @param $value
     * @return self
     */
    public function __set($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }

    /**
     * @param string $offset
     * @return mixed|null
     */
    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * @param array $data
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = [];

        return $this->addData($data);
    }

    /**
     * @param array $data
     * @return self
     */
    public function addData(array $data)
    {
        foreach ($data as $offset => $value) {
            $this->offsetSet($offset, $value);
        }

        return $this;
    }
}
