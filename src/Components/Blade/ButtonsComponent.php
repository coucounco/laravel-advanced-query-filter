<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class ButtonsComponent extends Component
{
    public $inline;
    public $dark;

    public function __construct($inline = false, $dark = false)
    {
        $this->inline = $inline;
        $this->dark = $dark;
    }

    public function render()
    {
        return view('laravel_aqf::blade._buttons');
    }
}