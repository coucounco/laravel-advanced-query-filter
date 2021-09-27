<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Blade;

use Illuminate\View\Component;

class ExportComponent extends Component
{
    public $name;
    public $route;
    public $label;
    public $helper;
    public $icon;

    public function __construct($name, $route, $label = null, $helper = null, $icon = null)
    {
        $this->name = $name;
        $this->route = $route;
        $this->label = $label;
        $this->helper = $helper;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('laravel_aqf::blade._export');
    }
}