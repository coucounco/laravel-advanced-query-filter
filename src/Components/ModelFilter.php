<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class ModelFilter extends FilterComponent
{
    public function boot()
    {
        Blade::include('laravel_aqf::_model', 'filterModel');
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

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $models = $this->value();
        if (isset($models)) {
            foreach ($models as $model => $ids) {
                $aqf->call($model, $query, $ids);
            }
        }
    }

    public function value()
    {
        $models = null;
        if ($this->request()->has('model')) {
            $models = $this->request()->input('model');
        }
        return $models;
    }
}
