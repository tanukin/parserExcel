<?php

namespace App\Repository;

use App\Entities\Box;
use App\Entities\Shipment;
use PDO;

class ShipmentBoxRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveAll(array $arrayShipmentsBoxes): bool
    {
        $sth = $this->pdo->prepare('INSERT INTO box_shipment (shipment_id, box_id) VALUES (:shipment_id, :box_id)');

        foreach ($arrayShipmentsBoxes as $shipmentBox) {
            $shipment = $shipmentBox[0];
            $box = $shipmentBox[1];

            if ($shipment instanceof Shipment && $box instanceof Box) {
                $sth->bindValue(':shipment_id', $shipment->getId(), PDO::PARAM_INT);
                $sth->bindValue(':box_id', $box->getId(), PDO::PARAM_INT);
                $sth->execute();
            }
        }

        return true;
    }
}