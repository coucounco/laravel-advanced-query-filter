<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

/**
 * Class CheckFilter.
 *
 * @author rohs
 */
class CheckFilter extends FilterComponent
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


    public function render()
    {
        return view('laravel_aqf::'.Filters::getTheme().'._check')->with([
            'check'  => $this->check,
            'label'   => $this->label,
            'default' => $this->default,
        ]);
    }

    public static function boot() {}
    public static function filter(AdvancedQueryFilter $aqf, Builder $query) {}
    public static function value() {}
}
