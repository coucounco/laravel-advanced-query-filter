<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\Components\FilterComponent;

class FilterService
{
    private $filters;
    private $request;

    public function __construct()
    {
        $this->filters = [];
        $this->request = request();
    }

    public function filters($filters)
    {
        foreach ($filters as $filter) {
            $this->registerFilterComponent($filter);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function registerFilterComponent($className) {
        $filter = new $className();
        $this->filters[$className] = $filter;
    }

    /**
     * @param $name
     * @return null|FilterComponent
     */
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
        Blade::include('laravel_aqf::_export', 'filterExport');
        Blade::include('laravel_aqf::_export_pdf', 'filterExportPdf');
        foreach ($this->filters as $filter) {
            $filter->boot();
        }
    }
}
