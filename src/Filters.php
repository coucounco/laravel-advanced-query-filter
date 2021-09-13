<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void boot()
 * @method static void setRequest(Request $request)
 * @method static Request getRequest()
 *
 * @see FilterService
 */
class Filters extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FilterService::class;
    }
}
