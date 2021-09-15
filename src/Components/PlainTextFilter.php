<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

class PlainTextFilter extends FilterComponent
{
    public function boot()
    {
        Blade::include('laravel_aqf::_plain', 'filterPlain');
    }

    public function render()
    {
        // TODO: Implement render() method.
    }

    public function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $text = $this->value();
        if (isset($text) && ! empty($text)) {
            $aqf->call('plain', $query, $text);
        }
    }

    public function value()
    {
        $text = null;
        if ($this->request()->has('plain')) {
            $text = $this->request()->input('plain');
        }
        return $text;
    }
}
