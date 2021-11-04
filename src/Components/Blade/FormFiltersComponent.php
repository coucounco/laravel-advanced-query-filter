<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class FormFiltersComponent extends Component
{
    public $menuToggle;
    public $inline;

    public function __construct($menuToggle = true, $inline = false)
    {
        $this->menuToggle = $menuToggle;
        $this->inline = $inline;
    }

    public function render()
    {
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'.blade._form');
    }
}