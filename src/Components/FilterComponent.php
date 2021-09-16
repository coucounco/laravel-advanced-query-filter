<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

abstract class FilterComponent extends Component implements Renderable
{
    public static abstract function boot();

    public static abstract function filter(AdvancedQueryFilter $aqf, Builder $query);

    /**
     * @return string|array
     */
    public static abstract function value();

    /**
     * @return Request
     */
    public static function request() {
        return Filters::getRequest();
    }
}
