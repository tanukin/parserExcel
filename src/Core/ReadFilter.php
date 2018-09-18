<?php

namespace App\Core;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        if ($row >= 2 && $row <= 5000) {
            if (in_array($column, range('B', 'C'))) {
                return true;
            }
        }
        return false;
    }
}