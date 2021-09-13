<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class AccountingRangeFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._accounting_range', 'filterAccountingRange');
    }

    public function name()
    {
        return 'accounting_range';
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
