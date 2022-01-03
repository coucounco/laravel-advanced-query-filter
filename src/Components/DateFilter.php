<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class DateFilter extends FilterComponent
{
    public $name;
    public $date;

    public function __construct($name, $date = null)
    {
        $this->name = $name;
        $this->date = $date;
    }

    public function render()
    {
        $selected = old(self::queryStringName())[$this->name] ?? self::value()[$this->name] ?? $this->date ?? null;
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'._date', compact('selected'));
    }

    public static function boot()
    {
        Blade::component('aqf-date', self::class);
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $dates = self::value();
        if (isset($dates)) {
            foreach ($dates as $name => $date) {
                $date = Carbon::parse($date);
                if(isset($date)) {
                    $aqf->call($name, $query, $date);
                }
            }
        }
    }

    public static function value()
    {
        $values = null;
        if (self::request()->has(self::queryStringName())) {
            $values = self::request()->input(self::queryStringName());
        }
        return $values;
    }

    public static function queryStringName(): string
    {
        return 'date';
    }
}