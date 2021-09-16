<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ButtonsComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ClearComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\FormFiltersComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\MenuToggleComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\SubmitComponent;
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
        Blade::component('aqf-filters', FormFiltersComponent::class);
        Blade::component('aqf-menu-toggle', MenuToggleComponent::class);
        Blade::component('aqf-buttons', ButtonsComponent::class);
        Blade::component('aqf-clear', ClearComponent::class);
        Blade::component('aqf-submit', SubmitComponent::class);
        foreach ($this->filters as $filter) {
            $filter->boot();
        }
    }

    public function registerFilterComponent($className) {
        $this->filters[$className] = new FilterContainer($className);
    }
}
