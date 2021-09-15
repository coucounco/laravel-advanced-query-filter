<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class CardFilter extends FilterComponent
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
    }

    public function name()
    {
    }

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        //
    }
}
