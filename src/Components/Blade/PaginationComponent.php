<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class PaginationComponent extends Component
{
    public $default;

    public function __construct($default = null)
    {
        $this->default = isset($default) ? $default : (config('aqf.pagination') ?? 50);
    }

    public function render()
    {
        $selectedPagination = request()->has('pagination') ? request()->input('pagination') : $this->default;
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'.blade._pagination', compact('selectedPagination'));
    }
}