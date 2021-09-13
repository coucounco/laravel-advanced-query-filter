<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

/**
 * Class Export.
 *
 * @author rohs
 */
class Pagination implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._pagination', 'filterPagination');
    }

    public function name()
    {
        return 'pagination';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
