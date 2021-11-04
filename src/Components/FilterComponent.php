<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

abstract class FilterComponent extends Component
{
    public static abstract function boot();

    public static abstract function filter(AdvancedQueryFilter $aqf, Builder $query);

    /**
     * @return string|array
     */
    public static abstract function value();

    public static abstract function queryStringName() : string;

    /**
     * @return Request
     */
    public static function request() {
        return Filters::getRequest();
    }
}
