<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class FormFiltersComponent extends Component
{
    public $menuToggle;
    public $inline;
    public $dark;

    public function __construct($menuToggle = true, $inline = false, $dark = false)
    {
        $this->menuToggle = $menuToggle;
        $this->inline = $inline;
        $this->dark = $dark;
    }

    public function render()
    {
        return view('laravel_aqf::blade._form');
    }
}