<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class SubmitComponent extends Component
{
    public $dark;

    public function __construct($dark = false)
    {
        $this->dark = $dark;
    }

    public function render()
    {
        return view('laravel_aqf::blade._submit');
    }
}