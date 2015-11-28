<?php namespace App\Model\Entities\Traits;

trait AccessibleProperties
{
    function __get($var)
    {
        $method = 'get' . ucfirst($var);

        if (! is_callable([$this, $method])) {
            throw new \Exception('Inaccessible property does not have getter method');
        }

        return $this->$method();
    }

    function __set($var, $val)
    {
        $method = 'set' . ucfirst($var);

        if (! is_callable([$this, $method])) {
            throw new \Exception('Inaccessible property does not have setter method');
        }

        $this->$method($val);
    }

    function offsetGet($offset)
    {
        return $this->$offset;
    }

    function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetExists($offset)
    {
        return (bool) $this->offsetGet($offset);
    }

    public function offsetUnset($offset)
    {
        $this->$offset = null;
    }
}