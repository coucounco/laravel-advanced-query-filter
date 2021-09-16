<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

class FilterContainer
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->name, $name], $arguments);
    }
}