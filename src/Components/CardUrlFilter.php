<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class CardUrlFilter extends FilterComponent
{
    private $url;
    private $label;

    public function __construct($url, $label)
    {
        $this->url = $url;
        $this->label = $label;
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'._card_url')->with([
            'url'   => $this->url,
            'label' => $this->label,
        ]);
    }

    public static function boot() {}

    public static function filter(AdvancedQueryFilter $aqf, Builder $query) {}

    public static function value() {}

    public static function queryStringName(): string { return ''; }
}
