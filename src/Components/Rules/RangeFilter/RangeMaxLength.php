<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Rules\RangeFilter;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Validation\Rule;
use rohsyl\LaravelAdvancedQueryFilter\Components\RangeFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class RangeMaxLength implements Rule
{
    private $interval;

    public function __construct(CarbonInterval $interval)
    {
        $this->interval = $interval;
    }

    public function passes($attribute, $value)
    {
        $value = Filters::getFilter(RangeFilter::class)->value();
        $valueInterval = $value[0]->diffAsCarbonInterval($value[1]);
        return $valueInterval->compare($this->interval) <= 0;
    }

    public function message()
    {
        return 'The :attribute must not exceed '. $this->interval->cascade()->forHumans() . '.';
    }
}