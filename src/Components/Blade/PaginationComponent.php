<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class PaginationComponent extends Component
{
    public $default;
    public $dark;

    public function __construct($default = null, $dark = false)
    {
        $this->default = isset($default) ? $default : (config('aqf.pagination') ?? 50);
        $this->dark = $dark;
    }

    public function render()
    {
        $selectedPagination = request()->has('pagination') ? request()->input('pagination') : $this->default;
        return view('laravel_aqf::blade._pagination', compact('selectedPagination'));
    }
}