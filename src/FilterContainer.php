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
        if(method_exists($this->name, $name)) {
            return call_user_func_array([$this->name, $name], $arguments);
        }
        return null;
    }
}