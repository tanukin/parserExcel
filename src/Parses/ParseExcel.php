<?php

namespace App\Parses;

use App\Entities\Box;
use App\Entities\Excel;
use App\Entities\Shipment;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParseExcel
{
    const READ_ROWS = [2, 5000];
    const READ_COLUMNS = ['B', 'C'];

    /**
     * @var XlsxFactory
     */
    private $xlsxFactory;

    /**
     * @var array
     */
    private $shipments = [];

    /**
     * @var array
     */
    private $boxes = [];

    /**
     * @var array
     */
    private $shipmentsBoxes = [];

    public function __construct(XlsxFactory $xlsxFactory)
    {
        $this->xlsxFactory = $xlsxFactory;
    }

    /**
     * @param string $fileName
     *
     * @return Worksheet
     *
     * @throws Exception
     */
    public function read(string $fileName): Worksheet
    {
        $reader = $this->xlsxFactory->getXlsx();
        $reader->setReadDataOnly(true);
        $reader->setReadFilter($this->xlsxFactory->getReadFilter(self::READ_ROWS, self::READ_COLUMNS));
        $spreadsheet = $reader->load($fileName);

        return $spreadsheet->getActiveSheet();
    }

    /**
     * @param Worksheet $worksheet
     *
     * @return Excel
     */
    public function execute(Worksheet $worksheet): Excel
    {
        $array = $worksheet->toArray();

        foreach ($array as $item) {
            array_shift($item);
            if (is_null($item[0]) && is_null($item[1]))
                continue;

            $cellShipment = trim($item[0]);
            $cellBox = trim($item[1]);

            $shipment_id = array_key_exists($cellShipment, $this->shipments);
            $box_id = array_key_exists($cellBox, $this->boxes);

            if (!($shipment_id)) {
                $this->shipments[$cellShipment] = new Shipment($cellShipment, count($this->shipments) + 1);
            }

            if (!($box_id)) {
                $this->boxes[$cellBox] = new Box($cellBox, count($this->boxes) + 1);
            }

            array_push($this->shipmentsBoxes, [$this->shipments[$cellShipment], $this->boxes[$cellBox]]);
        }

        return new Excel($this->shipments, $this->boxes, $this->shipmentsBoxes);
    }
}