<?php
namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class CardFilter extends FilterComponent
{
    public $name;
    public $default;
    public $label;

    public function __construct($name = 'all', $label = null, $default = false)
    {
        $this->name = $name;
        $this->default = $default;
        $this->label = $label;
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $selected = Filters::getFilter(CardsFilter::class)->value();
        return view(Filters::getViewNamespace().'::'.Filters::getTheme().'._card', compact('selected'))->with([
            'name' => $this->name,
            'default' => $this->default,
            'label' => $this->label,
        ]);
    }

    public static function boot() { }
    public static function filter(AdvancedQueryFilter $aqf, Builder $query) {}
    public static function value() {}
}
