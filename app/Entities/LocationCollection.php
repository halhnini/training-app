<?php

namespace App\Entities;

use App\Factory\LocationFactory;

class LocationCollection implements \IteratorAggregate, \ArrayAccess
{
    private $locations = [];

    public static function createFromArray(array $attributes): self
    {
        $collection = new self();
        foreach ($attributes as $item) {
            $location = LocationFactory::createFromArray($item);
            $collection->locations[] = $location;
        }

        return $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->locations);
    }

    public function offsetExists($offset)
    {
        return isset($this->locations[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->locations[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->locations[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->locations[$offset]);
    }
}
