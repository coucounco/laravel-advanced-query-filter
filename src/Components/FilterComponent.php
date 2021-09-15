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
    public abstract function boot();

    public abstract function filter(AdvancedQueryFilter $aqf, Builder $query);

    /**
     * @return string|array
     */
    public abstract function value();

    /**
     * @return Request
     */
    public function request() {
        return Filters::getRequest();
    }
}
