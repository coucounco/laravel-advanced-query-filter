<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class ModelFilter extends FilterComponent
{
    public $name;
    public $multiselect;
    public $list;

    public function __construct($name, $list, $multiselect = true)
    {
        $this->name = $name;
        $this->multiselect = $multiselect;
        $this->list = $list;
    }


    public static function boot()
    {
        Blade::component('aqf-model', self::class);
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $selected = old(self::queryStringName())[$this->name] ?? self::value()[$this->name] ?? null;
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'._model', compact('selected'));
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $models = self::value();
        if (isset($models)) {
            foreach ($models as $model => $ids) {
                $aqf->call($model, $query, $ids);
            }
        }
    }

    public static function value()
    {
        $models = null;
        if (self::request()->has(self::queryStringName())) {
            $models = self::request()->input(self::queryStringName());
        }
        return $models;
    }

    public static function queryStringName(): string
    {
        return 'model';
    }
}
