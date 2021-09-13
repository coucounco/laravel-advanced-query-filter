<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class MonthFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._month', 'filterMonth');
    }

    public function name()
    {
        return 'month';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
