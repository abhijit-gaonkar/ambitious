<?php

namespace Ambitious\Core\Views;

use Exception;
use JsonSerializable;

abstract class AbstractView implements JsonSerializable
{
    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }

    final public function __get($name)
    {
        throw new Exception("Invalid property {$name}");
    }

    final public function __set($name, $value)
    {
        throw new Exception("Invalid property {$name}");
    }

    public function jsonSerialize() {
        return $this;
    }
}
