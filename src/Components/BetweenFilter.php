<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class BetweenFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._between', 'filterBetween');
    }

    public function name()
    {
        return 'between';
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
