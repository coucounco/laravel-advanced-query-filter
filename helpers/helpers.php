<?php
/***********************************************************************************************
 * Filter helpers function
 ***********************************************************************************************/
if (! function_exists('OFilter')) {
    /**
     * Get the filter card.
     *
     * @param $filter string The name of the filter
     * @param $label string The label
     * @param  bool  $default  If this is the default filter
     * @return string
     */
    function OFilter($filter, $label, $default = false)
    {
        return new \rohsyl\LaravelAdvancedQueryFilter\Components\CardFilter($filter, $label, $default);
    }
}

if (! function_exists('OUrl')) {
    /**
     * Get the filter card.
     *
     * @param $filter
     * @param $label
     * @return string
     */
    function OUrl($url, $label)
    {
        return new \rohsyl\LaravelAdvancedQueryFilter\Components\CardUrlFilter($url, $label);
    }
}
if (! function_exists('OCheck')) {
    /**
     * Get the check checkbox.
     *
     * @param $check string The name of the check
     * @param $label string The label
     * @param  bool  $default  If this is the default filter
     * @return string
     */
    function OCheck($check, $label, $default = false)
    {
        return new \rohsyl\LaravelAdvancedQueryFilter\Components\CheckFilter($check, $label, $default);
    }
}