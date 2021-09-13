<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use App\Extensions\Filters\Export\FilterExporter;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

abstract class AdvancedQueryFilter
{
    protected $defaultRangeFrom = null;
    protected $defaultRangeTo = null;
    protected $defaultFilter = null;
    protected $defaultExportFileName = 'export.csv';
    protected $defaultChecks = null;
    protected $defaultMonthDates = null;
    protected $pagination = null;
    public $currentFilter = null;

    private $defaults;

    protected $scopes = [];

    private $request = null;

    public function call($method, ...$args) {
        if(method_exists($this, $method)) {
            $this->$method(...$args);
        }
    }

    public function filter()
    {
        $request = $this->request ?? request();
        $query = $this->query();

        if ($request->has('filter')) {
            $filter = $request->input('filter');

            if (method_exists($this, $filter)) {
                $this->$filter($query);
                $this->currentFilter = $filter;
            }
        } elseif (isset($this->defaultFilter)) {
            if (method_exists($this, $this->defaultFilter)) {
                $this->{$this->defaultFilter}($query);
            }
        }

        if ($request->has('range')) {
            $range = $this->getRangeDates();
            $from = $range[0];
            $to = $range[1];
            $range_field = ($this->request ?? request())->input('range_field');
            if (isset($from) && isset($to)) {
                if (method_exists($this, $range_field)) {
                    $this->$range_field($query, $from, $to);
                } else {
                    $this->range($query, $from, $to);
                }
            }
        } elseif (isset($this->defaultRangeFrom) && isset($this->defaultRangeTo)) {
            $this->range($query, $this->defaultRangeFrom, $this->defaultRangeTo);
        }

        if ($request->has('m')) {
            $months = $request->input('m');
            if (isset($months)) {
                foreach ($months as $month => $values) {
                    if (method_exists($this, $month)) {
                        $date = Carbon::create($values['y'], $values['m'], 1);
                        $this->$month($query, $date);
                    }
                }
            }
        } elseif (isset($this->defaultMonthDates) && ! empty($this->defaultMonthDates)) {
            foreach ($this->defaultMonthDates as $month => $date) {
                $this->$month($query, $date);
            }
        }

        if ($request->has('between')) {
            $betweens = $request->input('between');
            if (isset($betweens)) {
                foreach ($betweens as $between => $values) {
                    if (method_exists($this, $between)) {
                        $this->$between($query, $values['min'] ?? null, $values['max'] ?? null);
                    }
                }
            }
        }

        if ($request->has('plain')) {
            $text = $request->input('plain');
            if (isset($text) && ! empty($text)) {
                $this->plain($query, $text);
            }
        }

        if ($request->has('model')) {
            $models = $request->input('model');
            if (isset($models)) {
                foreach ($models as $model => $ids) {
                    if (method_exists($this, $model)) {
                        $this->$model($query, $ids);
                    }
                }
            }
        }

        if ($request->has('check')) {
            $checks = $request->input('check');
            if (isset($checks)) {
                $query->where(function ($query) use ($checks) {
                    foreach ($checks as $check => $enable) {
                        if (method_exists($this, $check) && isset($enable) && $enable) {
                            $this->$check($query, $enable);
                        }
                    }
                });
            }
        } elseif (isset($this->defaultChecks) && ! empty($this->defaultChecks)) {
            $query->where(function ($query) {
                foreach ($this->defaultChecks as $check => $enable) {
                    if (method_exists($this, $check) && isset($enable) && $enable) {
                        $this->$check($query, $enable);
                    }
                }
            });
        }

        if (isset($this->scopes) && is_array($this->scopes) && ! empty($this->scopes)) {
            foreach ($this->scopes as $scope) {
                call_user_func_array($scope, [$this, $query]);
            }
        }

        $query = $this->finalize($query);

        if (isset($this->pagination) && is_integer($this->pagination)) {
            // Only check for pagination override if page has pagination
            if ($request->has('pagination')) {
                $this->pagination($request->input('pagination'));
            }

            return $query->paginate($this->pagination)
                ->withPath(QueryFilterUrl::url());
        } else {
            return $query->get();
        }
    }

    public function export()
    {
        $this->pagination = null;
        $data = $this->filter();
        $request = $this->request ?? request();

        if ($request->has('export')) {
            $export = $request->input('export');
            if (method_exists($this, $export)) {
                $opt = $this->$export();

                return Excel::download(
                    new FilterExporter(
                        $data,
                        $opt[0] ?? [],
                        $opt[1] ?? null
                    ),
                    $opt[2] ?? $this->defaultExportFileName
                );
            }
        }

        return 'nothing to export...';
    }

    public function export_pdf()
    {
        $this->pagination = null;
        $data = $this->filter();
        $request = $this->request ?? request();

        if ($request->has('export_pdf')) {
            $export = $request->input('export_pdf');

            $opt = $this->$export();

            $pdf = PDF::loadView(
                $opt['view'],
                [
                    $opt['var_name'] => $data,
                ],
                [],
                $opt['configuration']
            );

            return $pdf->stream($opt['filename']);
        }

        return 'nothing to export...';
    }

    public function count($callback = null)
    {
        $query = $this->query();
        if (isset($callback) && is_callable($callback)) {
            $callback($this, $query);
        }
        $query = $this->finalize($query);

        return $query->count();
    }

    abstract public function query();

    public function finalize($query)
    {
        return $query;
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     * @codeCoverageIgnore
     */
    public function range($query, $from, $to)
    {
        return $query;
    }

    /**
     * @param $query
     * @param $table
     * @return bool
     *
     * @deprecated
     * @codeCoverageIgnore
     */
    protected function join_exists($query, $table)
    {
        foreach ($query->getQuery()->joins ?? [] as $join) {
            if ($join->table == $table) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $query
     * @param $text
     * @return mixed
     * @codeCoverageIgnore
     */
    public function plain($query, $text)
    {
        return $query;
    }

    public function getRangeDates()
    {
        $range = ($this->request ?? request())->input('range');
        $dates = explode(',', $range);
        $from = isset($dates[0]) && ! empty($dates[0]) ? cdateparse($dates[0], false) : null;
        $to = isset($dates[1]) && ! empty($dates[1]) ? cdateparse($dates[1], false) : null;

        return [$from, $to];
    }

    public function getMonthDate($name, $returnDefault = false)
    {
        if (request()->has('m') && request()->input('m')[$name] !== null) {
            $values = request()->m[$name];

            return Carbon::create($values['y'], $values['m']);
        }
        if ($returnDefault && isset($this->defaultMonthDates[$name])) {
            return $this->defaultMonthDates[$name];
        }

        return null;
    }

    public function getModelIds($name)
    {
        if (request()->has('model') && request()->input('model')[$name] !== null) {
            return request()->input('model')[$name];
        }

        return null;
    }

    public function rangeDefaultDates($from, $to)
    {
        $this->defaultRangeFrom = $from;
        $this->defaultRangeTo = $to;

        return $this;
    }

    public function pagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function scope(callable $callable)
    {
        $this->scopes[] = $callable;

        return $this;
    }

    public function defaults() {
        if(!isset($this->defaults)) {
            $this->defaults = new DefaultsBag();
        }
        return $this->defaults;
    }

    /**
     * @return null
     */
    public function getDefaultRangeFrom()
    {
        return $this->defaultRangeFrom;
    }

    /**
     * @return null
     */
    public function getDefaultRangeTo()
    {
        return $this->defaultRangeTo;
    }

    public function setRequest($request)
    {
        Filters::setRequest($request);
        return $this;
    }
}
