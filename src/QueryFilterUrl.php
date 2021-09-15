<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

use Illuminate\Support\Arr;

class QueryFilterUrl
{
    // add the filter querystring to the current url
    public static function filter($filter)
    {
        return request()->url().'?'.Arr::query(array_merge(request()->query(), ['filter' => $filter]));
    }

    public static function view($name, $onlyView = false)
    {
        return request()->url().'?'.Arr::query(array_merge($onlyView ? [] : request()->query(), ['view' => $name]));
    }

    public static function cleanUrl($withView = true)
    {
        $url = request()->url();
        if ($withView && request()->has('view')) {
            $url .= '?'.Arr::query(['view' => request()->input('view')]);
        }

        return $url;
    }

    public static function parameters()
    {
        return request()->query();
    }

    public static function url()
    {
        return request()->fullUrl();
    }

    public static function withRange($from, $to = null)
    {
        if (! isset($to)) {
            $to = $from;
        }
        $range = $from->format(Filters::DATEFORMAT).','.$to->format(Filters::DATEFORMAT);

        return request()->url().'?'.Arr::query(array_merge(request()->query(), ['range' => $range]));
    }

    public static function norange()
    {
        $url = request()->url();

        $queryString = Arr::query(array_filter(request()->query(), function ($key) {
            return $key != 'range';
        }, ARRAY_FILTER_USE_KEY));

        if (isset($queryString) && ! empty($queryString)) {
            $url .= '?'.$queryString;
        }

        return $url;
    }

    public static function nomodel($model)
    {
        $url = request()->url();

        $queryString = Arr::query(array_filter(request()->query(), function ($key) {
            return $key != 'model';
        }, ARRAY_FILTER_USE_KEY));

        if (isset($queryString) && ! empty($queryString)) {
            $url .= '?'.$queryString;
        }

        return $url;
    }

    private $url;
    private $query = [];

    /**
     * @param $url
     * @return QueryFilterUrl
     */
    public static function createUrl($url)
    {
        return new self($url);
    }

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function viewd($name)
    {
        $this->query['view'] = $name;

        return $this;
    }

    public function model($name, $values)
    {
        if (is_array($values)) {
            foreach ($values as $key=>$value) {
                $this->query['model['.$name.']['.$key.']'] = $value;
            }
        } else {
            $this->query['model['.$name.']'] = $values;
        }

        return $this;
    }

    public function range($from, $to)
    {
        $this->query['range'] = $from->format(Filters::DATEFORMAT).','.$to->format(Filters::DATEFORMAT);

        return $this;
    }

    public function filterd($filter)
    {
        $this->query['filter'] = $filter;

        return $this;
    }

    public function get()
    {
        $queryString = Arr::query($this->query);

        if (isset($queryString) && ! empty($queryString)) {
            $this->url .= '?'.$queryString;
        }

        return $this->url;
    }
}
