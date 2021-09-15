<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\Blade;

class FilterService
{
    private $filters;
    private $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function filters($filters)
    {
        $instances = [];
        foreach ($filters as $filter) {
            $f = new $filter();
            $instances[$filter] = $f;
        }
        $this->filters = $instances;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function getFilter($name) {
        return $this->filters[$name] ?? null;
    }

    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function boot()
    {
        Blade::aliasComponent('laravel_aqf::_form', 'filters');
        Blade::include('laravel_aqf::_pagination', 'filterPagination');
        foreach ($this->filters as $filter) {
            $filter->boot();
        }
    }
}
