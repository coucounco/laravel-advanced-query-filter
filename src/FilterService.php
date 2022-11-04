<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ButtonsComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ClearComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ExportComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\ExportPdfComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\FormFiltersComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\MenuToggleComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\PaginationComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\Blade\SubmitComponent;
use rohsyl\LaravelAdvancedQueryFilter\Components\FilterComponent;

class FilterService
{
    /**
     * @var FilterContainer[]
     */
    private $filters;
    private $request;
    private $themeName;
    private $viewNamespace;

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
     * @return FilterContainer[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function getFiltersQueryString() {
        $queryStrings = [];
        foreach($this->getFilters() as $filter) {
            $queryStrings[] = $filter->queryStringName();
        }
        return $queryStrings;
    }

    /**
     * @param $name
     * @return null|FilterContainer
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
        Blade::component('aqf-pagination', PaginationComponent::class);
        Blade::component('aqf-export', ExportComponent::class);
        Blade::component('aqf-export-pdf', ExportPdfComponent::class);
        foreach ($this->filters as $filter) {
            $filter->boot();
        }
    }

    public function theme(string $name = null) {
        $this->themeName = $name;
    }

    public function viewNamespace(string $viewNamespace = null) {
        $this->viewNamespace = $viewNamespace;
    }

    public function isFilterActive($name) {
        $request = $this->getRequest();

        return $request->has($name) && !empty($request->input($name));
    }

    public function classFilterActive($name, $class) {
        return $this->isFilterActive($name) ? $class : '';
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->themeName ?? 'default';
    }

    public function getViewNamespace() {
        return $this->viewNamespace ?? 'laravel_aqf';
    }

    public function registerFilterComponent($className) {
        $this->filters[$className] = new FilterContainer($className);
    }
}
