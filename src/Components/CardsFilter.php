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

        $aqf->call($filter, $query);

        if (isset($filter)) {
            if (method_exists($aqf, $filter)) {
                $aqf->$filter($query);
                $this->currentFilter = $filter;
            }
        } elseif (isset($this->defaultFilter)) {
            if (method_exists($aqf, $this->defaultFilter)) {
                $aqf->{$this->defaultFilter}($query);
            }
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
