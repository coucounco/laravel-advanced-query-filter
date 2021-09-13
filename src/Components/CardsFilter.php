<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class CardsFilter extends FilterComponent
{
    public function boot()
    {
        Blade::include('components.filter._cards', 'filterCards');
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
    }

    public function name()
    {
        return 'filter';
    }

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $filter = $this->getFilter();

        if (isset($filter)) {
            $aqf->call($filter, $query);
        } elseif ($aqf->defaults()->defaultFilter !== null) {
            $aqf->call($aqf->defaults()->defaultFilter, $query);
        }
    }

    public function getFilter() {
        $filter = null;
        if ($this->request()->has('filter')) {
            $filter = $this->request()->input('filter');
        }

        return $filter;
    }
}
