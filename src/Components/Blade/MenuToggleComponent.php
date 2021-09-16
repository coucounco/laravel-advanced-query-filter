<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class MenuToggleComponent extends Component
{

    public $label;

    public function __construct($label = 'Menu')
    {
        $this->label = $label;
    }

    public function render()
    {
        return view('laravel_aqf::blade._menu_toggle');
    }
}