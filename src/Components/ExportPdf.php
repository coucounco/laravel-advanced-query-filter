<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

/**
 * Class Export.
 *
 * @author rohs
 */
class ExportPdf implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._export_pdf', 'filterExportPdf');
    }

    public function name()
    {
        return 'export_pdf';
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
