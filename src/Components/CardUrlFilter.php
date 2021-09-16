<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;

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
        return view('laravel_aqf::_card_url')->with([
            'url'   => $this->url,
            'label' => $this->label,
        ]);
    }

    public static function boot() {}

    public static function filter(AdvancedQueryFilter $aqf, Builder $query) {}

    public static function value() {}
}
