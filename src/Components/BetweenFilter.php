<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class BetweenFilter extends FilterComponent
{
    public function boot()
    {
        Blade::include('laravel_aqf::_between', 'filterBetween');
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
    }

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $betweens = $this->value();
        if (isset($betweens)) {
            foreach ($betweens as $between => $values) {
                $aqf->call($between, $query, $values['min'] ?? null, $values['max'] ?? null);
            }
        }
    }

    public function value()
    {
        $betweens = null;
        if ($this->request()->has('between')) {
            $betweens = $this->request()->input('between');
        }
        return $betweens;
    }
}
