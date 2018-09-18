<?php

namespace App\Parses;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class XlsxFactory
{
    /**
     * Return Xlsx Reader instance
     *
     * @return Xlsx
     */
    public function getXlsx(): Xlsx
    {
        return new Xlsx();
    }

    public function getReadFilter(array $rows, array $columns): ReadFilter
    {
        return new ReadFilter($rows, $columns);
    }

}