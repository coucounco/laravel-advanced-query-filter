<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class SubmitComponent extends Component
{
    public function render()
    {
        return view('laravel_aqf::'.Filters::getTheme().'.blade._submit');
    }
}