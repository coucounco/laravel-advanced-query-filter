<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Carbon\Carbon;

/**
 * @property string defaultFilter Default filter for CardsFilter component
 * @property Carbon defaultRangeFrom Default range from date for RangeFilter component
 * @property Carbon defaultRangeTo Default range to date for RangeFilter component
 * @property array defaultChecks Defaults values for ChecksFilter component
 * @property array defaultMonthDates Defualts values for MonthFilter component
 * @property string defaultExportFileName Default export filename for csv/xls export
 */
class DefaultsBag
{
    private $attributes;

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

}