<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Export;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Class FilterExporter.
 *
 * @author rohs
 */
class FilterExporter implements FromCollection, WithHeadings, WithMapping
{
    private $collection;
    private $heading;
    public $mapCallback;

    public function __construct($collection, $heading, $map)
    {
        $this->collection = $collection;
        $this->heading = $heading;
        $this->mapCallback = $map;
    }

    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return $this->heading;
    }

    public function map($row): array
    {
        if (is_callable($this->mapCallback)) {
            return call_user_func_array($this->mapCallback, [$row]);
        } elseif (is_a($row, Arrayable::class)) {
            return $row->toArray();
        }

        return [];
    }
}
