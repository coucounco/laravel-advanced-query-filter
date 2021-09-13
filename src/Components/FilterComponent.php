<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

abstract class FilterComponent implements Renderable
{
    public abstract function boot();

    public abstract function name();

    public abstract function filter(AdvancedQueryFilter $aqf, Builder $query);

    /**
     * @return Request
     */
    public function request() {
        return Filters::getRequest();
    }
}
