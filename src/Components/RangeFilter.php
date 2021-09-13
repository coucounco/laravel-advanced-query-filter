<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class RangeFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._range', 'filterRange');
    }

    public function name()
    {
        return 'range';
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
    }
}
