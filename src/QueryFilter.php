<?php

namespace rohsyl\LaravelAdvancedQueryFilter;

/**
 * Class QueryFilter.
 *
 * @deprecated This class will be deprecated since 2.8.12, You should use AdvancedQueryFilter instead.
 */
abstract class QueryFilter
{
    public function filter($filter)
    {
        if (method_exists($this, $filter)) {
            return $this->$filter();
        }

        return $this->default();
    }

    abstract public function default();
}
