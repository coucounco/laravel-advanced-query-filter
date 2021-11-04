<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class MenuToggleComponent extends Component
{

    public $label;

    public function __construct($label = 'Menu')
    {
        $this->label = $label;
    }

    public function render()
    {
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'.blade._menu_toggle');
    }
}