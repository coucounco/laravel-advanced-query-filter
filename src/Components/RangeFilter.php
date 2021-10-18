<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class RangeFilter extends FilterComponent
{
    public $inline;
    public $start;
    public $end;
    public $rangeField;

    public function __construct($start = null, $end = null, $rangeField = null, $inline = false)
    {
        $this->start = $start;
        $this->end = $end;
        $this->rangeField = $rangeField;
        $this->inline = $inline;
    }

    public static function boot()
    {
        Blade::component('aqf-range', self::class);
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $value = self::value();
        $range = null;
        $start = $value[0] ?? $this->start ?? null;
        $end = $value[1] ?? $this->end ?? null;
        if(isset($start) && isset($end)) {
            $range = $start->format(\rohsyl\LaravelAdvancedQueryFilter\Filters::DATEFORMAT) . ',' . $end->format(\rohsyl\LaravelAdvancedQueryFilter\Filters::DATEFORMAT);
        }
        return view('laravel_aqf::'.Filters::getTheme().'._range', compact('range', 'start', 'end'));
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        // get the value from the query string and formated
        $range = self::value();

        if (isset($range) && !empty($range)) {
            $from = $range[0] ?? null;
            $to = $range[1] ?? null;
            $range_field = $range[2] ?? null;
            if (isset($from) && isset($to)) {
                if(isset($range_field)) {
                    $aqf->call($range_field, $query, $from, $to);
                }
                else {
                    $aqf->call('range', $query, $from, $to);
                }
            }
        } elseif ($aqf->defaults()->defaultRangeFrom !== null && $aqf->defaults()->defaultRangeTo !== null) {
            $aqf->call('range', $query, $aqf->defaults()->defaultRangeFrom, $aqf->defaults()->defaultRangeTo);
        }
    }

    /**
     * @return array|null
     */
    public static function value()
    {
        $range = null;
        if (self::request()->has('range')) {
            $range = self::getRangeDates();
        }
        return $range;
    }

    /**
     * @return array
     */
    private static function getRangeDates()
    {
        $range = self::request()->input('range');
        $dates = explode(',', $range);
        $from = isset($dates[0]) && ! empty($dates[0]) ? Carbon::parse($dates[0]) : null;
        $to = isset($dates[1]) && ! empty($dates[1]) ? Carbon::parse($dates[1]) : null;
        $range_field = self::request()->input('range_field');

        return [$from, $to, $range_field];
    }
}
