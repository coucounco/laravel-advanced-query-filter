<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

/**
 * Class CheckFilter.
 *
 * @author rohs
 */
class CheckFilter implements FilterComponent
{
    private $check;
    private $label;
    private $default;

    public function __construct($check, $label, $default = false)
    {
        $this->check = $check;
        $this->label = $label;
        $this->default = $default;
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function name()
    {
        // TODO: Implement name() method.
    }

    public function render()
    {
        return view('components.filter._check')->with([
            'check'  => $this->check,
            'label'   => $this->label,
            'default' => $this->default,
        ]);
    }
}
