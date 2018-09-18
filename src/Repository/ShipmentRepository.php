<?php

namespace App\Repository;

use App\Entities\Shipment;
use App\Interfaces\RepositoryInterface;
use PDO;

class ShipmentRepository implements RepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveAll(array $arrayShipment): bool
    {
        $sth = $this->pdo->prepare('INSERT INTO shipments (id, name) VALUES (:id, :name)');

        foreach ($arrayShipment as $shipment) {
            if ($shipment instanceof Shipment) {
                $sth->bindValue(':id', $shipment->getId(), PDO::PARAM_INT);
                $sth->bindValue(':name', $shipment->getName(), PDO::PARAM_STR);
                $sth->execute();
            }
        }

        return true;
    }
}