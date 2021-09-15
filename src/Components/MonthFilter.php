<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class MonthFilter extends FilterComponent
{
    public function boot()
    {
        Blade::include('laravel_aqf::_month', 'filterMonth');
    }

    public function render()
    {
        // TODO: Implement render() method.
    }

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $months = $this->value();
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

    public function value()
    {
        $months = null;
        if ($this->request()->has('m')) {
            $months = $this->request()->input('m');
        }
        return $months;
    }
}
