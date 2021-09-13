<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

/**
 * Class Export.
 *
 * @author rohs
 */
class Export implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._export', 'filterExport');
    }

    public function name()
    {
        return 'export';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
