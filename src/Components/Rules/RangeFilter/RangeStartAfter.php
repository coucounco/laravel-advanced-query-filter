<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components\Rules\RangeFilter;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use rohsyl\LaravelAdvancedQueryFilter\Components\RangeFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class RangeStartAfter implements Rule
{
    private $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    public function passes($attribute, $value)
    {
        $value = Filters::getFilter(RangeFilter::class)->value();
        return $value[0]->greaterThanOrEqualTo($this->date);
    }

    public function message()
    {
        return 'The :attribute must start at or after '. $this->date->format(\rohsyl\LaravelAdvancedQueryFilter\Filters::DATEFORMAT) . '.';
    }
}