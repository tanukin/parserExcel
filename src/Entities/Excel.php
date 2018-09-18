<?php

namespace App\Entities;

class Excel
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

    public function __construct(array $shipments, array $boxes, array $shipmentsBoxes)
    {
        $this->shipments = $shipments;
        $this->boxes = $boxes;
        $this->shipmentsBoxes = $shipmentsBoxes;
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