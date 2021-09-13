<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

/**
 * Class ChecksFilter.
 *
 * @author rohs
 */
class ChecksFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._checks', 'filterChecks');
    }

    public function name()
    {
        return 'checks';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
