<?php
namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Facades\App;
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
use rohsyl\LaravelAdvancedQueryFilter\Console\CreateAdvancedQueryFilterCommand;

class ServiceProvider extends SP
{
    private $filters = [
        CardsFilter::class,
        ModelFilter::class,
        RangeFilter::class,
        MonthFilter::class,
        BetweenFilter::class,
        PlainTextFilter::class,
        ChecksFilter::class,
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateAdvancedQueryFilterCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/aqf.php' => config_path('aqf.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel_aqf');

        Filters::boot();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/aqf.php', 'aqf'
        );

        $this->app->bind(FilterService::class, function () {
            return (new FilterService())->filters($this->filters);
        });

    }
}
