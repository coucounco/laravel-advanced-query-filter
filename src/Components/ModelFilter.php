<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class ModelFilter extends FilterComponent
{

    public $dark;
    public $name;
    public $multiselect;
    public $list;

    public function __construct($name, $list, $multiselect = true, $dark = false)
    {
        $this->dark = $dark;
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
        $selected = self::value();
        return view('laravel_aqf::_model', compact('selected'));
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
        if (self::request()->has('model')) {
            $models = self::request()->input('model');
        }
        return $models;
    }
}
