<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class ButtonsComponent extends Component
{
    public $inline;

    public function __construct($inline = false)
    {
        $this->inline = $inline;
    }

    public function render()
    {
        return view('laravel_aqf::'.Filters::getTheme().'.blade._buttons');
    }
}