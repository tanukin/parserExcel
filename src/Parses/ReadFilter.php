<?php

namespace App\Parses;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ReadFilter implements IReadFilter
{
    /**
     * @var array
     */
    private $rows;
    /**
     * @var array
     */
    private $columns;

    public function __construct(array $rows, array $columns)
    {
        $this->rows = $rows;
        $this->columns = $columns;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        if ($row >= $this->rows[0] && $row <= $this->rows[1]) {
            if (in_array($column, $this->columns)) {
                return true;
            }
        }

        return false;
    }
}