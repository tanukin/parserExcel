<?php

namespace App\Core;

use PhpOffice\PhpSpreadsheet\Exception as PhpOfficeException;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReadExcel
{
    /**
     * @var string
     */
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return Worksheet
     *
     * @throws Exception
     * @throws PhpOfficeException
     */
    public function read()
    {
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        $reader->setReadFilter(new ReadFilter());
        $spreadsheet = $reader->load($this->fileName);

        return $spreadsheet->getActiveSheet();
    }

}