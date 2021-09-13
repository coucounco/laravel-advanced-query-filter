<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

class CardUrlFilter implements FilterComponent
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
        return view('components.filter._card_url')->with([
            'url'   => $this->url,
            'label' => $this->label,
        ]);
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function name()
    {
        // TODO: Implement value() method.
    }
}
