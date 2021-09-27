<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class MonthFilter extends FilterComponent
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function boot()
    {
        Blade::component('aqf-month', self::class);
    }

    public function render()
    {
        $selected = self::value()[$this->name] ?? [];
        $selectedMonth = $selected['m'] ?? (isset($date) ? $date->month : null) ?? Carbon::today()->month;
        $selectedYear = $selected['y'] ?? (isset($date) ? $date->year : null) ?? Carbon::today()->year;
        $years = range(2017, Carbon::today()->year);
        $years = array_combine($years, $years);
        $months = [];
        foreach(range(1, 12) as $i) {
            $months[$i] = Carbon::create($selectedYear, $i, 1)->format('F');
        }
        return view('laravel_aqf::'.Filters::getTheme().'._month', compact('years', 'months', 'selectedYear', 'selectedMonth'));
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $months = self::value();
        if (isset($months)) {
            foreach ($months as $month => $values) {
                $date = Carbon::create($values['y'], $values['m'], 1);
                $aqf->call($month, $query, $date);
            }
        } elseif ($aqf->defaults()->defaultMonthDates !== null && !empty($aqf->defaults()->defaultMonthDates)) {
            foreach ($aqf->defaults()->defaultMonthDates as $month => $date) {
                $aqf->call($month, $query, $date);
            }
        }
    }

    public static function value()
    {
        $months = null;
        if (self::request()->has('m')) {
            $months = self::request()->input('m');
        }
        return $months;
    }
}
