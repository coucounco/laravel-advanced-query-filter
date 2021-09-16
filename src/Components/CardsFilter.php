<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class CardsFilter extends FilterComponent
{
    public static function boot()
    {
        Blade::component('aqf-cards', self::class);
        Blade::component('aqf-card', CardFilter::class);
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $selectedFilter = Filters::getFilter(CardsFilter::class)->value();
        return view('laravel_aqf::_cards', compact('selectedFilter'));
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $filter = self::value();

        if (isset($filter)) {
            $aqf->call($filter, $query);
        } elseif ($aqf->defaults()->defaultFilter !== null) {
            $aqf->call($aqf->defaults()->defaultFilter, $query);
        }
    }

    public static function value() {
        $filter = null;
        if (self::request()->has('filter')) {
            $filter = self::request()->input('filter');
        }

        return $filter;
    }
}
