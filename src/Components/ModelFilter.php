<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Support\Facades\Blade;

class ModelFilter implements FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._model', 'filterModel');
    }

    public function name()
    {
        return 'model';
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
