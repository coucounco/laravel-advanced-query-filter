<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use rohsyl\LaravelAdvancedQueryFilter\Components\FilterComponent;

/**
 * @method static void boot()
 * @method static void registerFilterComponent(string $className)
 * @method static void setRequest(Request $request)
 * @method static Request getRequest()
 * @method static FilterContainer[] getFilters()
 * @method static FilterContainer getFilter($name)
 * @method static void theme(string $name)
 * @method static string getTheme()
 *
 * @see FilterService
 */
class Filters extends Facade
{

    const DATEFORMAT = 'd.m.Y';

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
