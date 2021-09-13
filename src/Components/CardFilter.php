<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class CardFilter implements FilterComponent
{
    private $filter;
    private $label;
    private $default;

    public function __construct($filter, $label, $default = false)
    {
        $this->filter = $filter;
        $this->label = $label;
        $this->default = $default;
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return view('components.filter._card')->with([
            'filter'  => $this->filter,
            'label'   => $this->label,
            'default' => $this->default,
        ]);
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function name()
    {
        // TODO: Implement value() method.
    }

    public function filter(AdvancedQueryFilter $aqf, Request $request, Builder $query)
    {
        // TODO: Implement filter() method.
    }
}
