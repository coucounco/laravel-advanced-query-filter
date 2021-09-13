<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class PlainTextFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._plain', 'filterPlain');
    }

    public function name()
    {
        return 'plain';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
