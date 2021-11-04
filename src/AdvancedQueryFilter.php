<?php
namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use rohsyl\LaravelAdvancedQueryFilter\Export\FilterExporter;
use Maatwebsite\Excel\Facades\Excel;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

abstract class AdvancedQueryFilter
{
    /**
     * @var DefaultsBag Contains all default values
     */
    private $defaults;

    protected $scopes = [];
    protected $pagination = null;
    protected $validation = false;

    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    private $validator;

    public function __construct()
    {
        $this->pagination = config('aqf.pagination') ?? null;
    }

    public function call($method, ...$args) {
        if(method_exists($this, $method)) {
            $this->$method(...$args);
        }
    }

    public function rules() {
        return null;
    }

    public function filter()
    {
        $request = Filters::getRequest();
        $query = $this->query();

        foreach(Filters::getFilters() as $filter) {
            $filter->filter($this, $query);
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
        $request = Filters::getRequest();

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
                    $opt[2] ?? $this->defaultExportFileName ?? 'export.csv'
                );
            }
        }

        return 'nothing to export...';
    }

    public function export_pdf()
    {
        $this->pagination = null;
        $data = $this->filter();
        $request = Filters::getRequest();

        if ($request->has('export_pdf')) {
            $export = $request->input('export_pdf');

            $opt = $this->$export();

            $pdf = PDF::loadView(
                $opt['view'],
                [
                    $opt['var_name'] => $data,
                    'data' => $opt['data'] ?? []
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

    /**
     * @return DefaultsBag
     */
    public function defaults() {
        if(!isset($this->defaults)) {
            $this->defaults = new DefaultsBag();
        }
        return $this->defaults;
    }

    public function setRequest($request)
    {
        Filters::setRequest($request);
        return $this;
    }

    public function validate() {
        if($this->validation) {
            $request = Filters::getRequest();
            $queryStrings = Filters::getFiltersQueryString();
            $rules = $this->rules();
            $values = array_filter($request->all($queryStrings));

            if(isset($rules) && !empty($rules) && isset($values) && !empty($values)) {
                $this->validator = Validator::make($values, $rules);
            }
            else {
                $this->validator = null;
            }
        }
    }

    public function redirectBack() {
        return redirect()
            ->to(QueryFilterUrl::cleanUrl())
            ->withErrors($this->validator)
            ->withInput();
    }

    /**
     * @return array|false
     */
    public function validationFails() {
        if(!isset($this->validator)) {
            return false;
        }

        return $this->validator->fails();
    }
}
