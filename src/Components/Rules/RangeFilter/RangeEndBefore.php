<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Rules\RangeFilter;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use rohsyl\LaravelAdvancedQueryFilter\Components\RangeFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class RangeEndBefore implements Rule
{
    private $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    public function passes($attribute, $value)
    {
        $value = Filters::getFilter(RangeFilter::class)->value();
        return $value[1]->lessThanOrEqualTo($this->date);
    }

    public function message()
    {
        return 'The :attribute must end at or before '. $this->date->format(\rohsyl\LaravelAdvancedQueryFilter\Filters::DATEFORMAT) . '.';
    }
}
