<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class MonthFilter extends FilterComponent
{
    public static function boot()
    {
        Blade::include('laravel_aqf::_month', 'filterMonth');
    }

    public function render()
    {
        // TODO: Implement render() method.
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
