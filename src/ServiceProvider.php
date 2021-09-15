<?php
namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as SP;
use rohsyl\LaravelAdvancedQueryFilter\Components\AccountingRangeFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\BetweenFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\CardsFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\ChecksFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\Export;
use rohsyl\LaravelAdvancedQueryFilter\Components\ExportPdf;
use rohsyl\LaravelAdvancedQueryFilter\Components\ModelFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\MonthFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\Pagination;
use rohsyl\LaravelAdvancedQueryFilter\Components\PlainTextFilter;
use rohsyl\LaravelAdvancedQueryFilter\Components\RangeFilter;

class ServiceProvider extends SP
{
    private $filters = [
        CardsFilter::class,
        ModelFilter::class,
        RangeFilter::class,
        AccountingRangeFilter::class,
        MonthFilter::class,
        BetweenFilter::class,
        PlainTextFilter::class,
        Export::class,
        ExportPdf::class,
        ChecksFilter::class,
        Pagination::class,
    ];

    public function boot()
    {
        Filters::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel_aqf');
    }

    public function register()
    {
        $this->app->bind(FilterService::class, function () {
            return (new FilterService())->filters($this->filters);
        });
    }
}
