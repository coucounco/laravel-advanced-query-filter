<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method mixed value()
 * @method mixed boot()
 * @method mixed filter(AdvancedQueryFilter $aqf, Builder $query)
 *
 */
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