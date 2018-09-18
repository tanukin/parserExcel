<?php

namespace App\Services;

use App\Entities\Box;
use App\Entities\Shipment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParseService
{
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

    public function execute(Worksheet $worksheet)
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
    }

    /**
     * @return array
     */
    public function getShipments(): array
    {
        return array_values($this->shipments);
    }

    /**
     * @return array
     */
    public function getBoxes(): array
    {
        return array_values($this->boxes);
    }

    /**
     * @return array
     */
    public function getShipmentsBoxes(): array
    {
        return $this->shipmentsBoxes;
    }
}