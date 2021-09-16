<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

/**
 * Class ChecksFilter.
 *
 * @author rohs
 */
class ChecksFilter extends FilterComponent
{
    public static function boot()
    {
        Blade::include('laravel_aqf::_checks', 'filterChecks');
    }

    public function render()
    {
        // TODO: Implement render() method.
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $checks = self::value();

        if (isset($checks)) {
            $query->where(function ($query) use ($aqf, $checks) {
                foreach ($checks as $check => $enable) {
                    if (isset($enable) && $enable) {
                        $aqf->call($check, $query, $enable);
                    }
                }
            });
        }
        elseif ($aqf->defaults()->defaultChecks !== null && $aqf->defaults()->defaultChecks !== null) {
            $query->where(function ($query) use ($aqf) {
                foreach ($aqf->defaults()->defaultChecks as $check => $enable) {
                    if (isset($enable) && $enable) {
                        $aqf->call($check, $query, $enable);
                    }
                }
            });
        }
    }

    public static function value()
    {
        $checks = null;
        if (self::request()->has('check')) {
            $checks = self::request()->input('check');
        }
        return $checks;
    }
}
