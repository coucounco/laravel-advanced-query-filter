<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

/**
 * Class ChecksFilter.
 *
 * @author rohs
 */
class ChecksFilter extends FilterComponent
{

    public function render()
    {
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'._checks');
    }

    public static function boot()
    {
        Blade::component('aqf-checks', self::class);
        Blade::component('aqf-check', CheckFilter::class);
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
        if (self::request()->has(self::queryStringName())) {
            $checks = self::request()->input(self::queryStringName());
        }
        return $checks;
    }

    public static function queryStringName(): string
    {
        return 'check';
    }
}
