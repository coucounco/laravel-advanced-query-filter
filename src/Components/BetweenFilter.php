<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class BetweenFilter extends FilterComponent
{
    public $name;
    public $inline;
    public $label;

    public function __construct($name, $label = null, $inline = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->inline = $inline;
    }

    public static function boot()
    {
        //Blade::include('laravel_aqf::_between', 'filterBetween');
        Blade::component('aqf-between', self::class);
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $value = self::value();
        $min = $value[$this->name]['min'] ?? null;
        $max = $value[$this->name]['max'] ?? null;
        return view('laravel_aqf::'.Filters::getTheme().'._between', compact('min', 'max'));
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $betweens = self::value();
        if (isset($betweens)) {
            foreach ($betweens as $between => $values) {
                $aqf->call($between, $query, $values['min'] ?? null, $values['max'] ?? null);
            }
        }
    }

    public static function value()
    {
        $betweens = null;
        if (self::request()->has('between')) {
            $betweens = self::request()->input('between');
        }
        return $betweens;
    }
}
