<?php

namespace App\Core;

use App\Repository\BoxRepository;
use App\Repository\ShipmentBoxRepository;
use App\Repository\ShipmentRepository;
use PDO;

class DatabaseFactory
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getBox(): Database
    {
        return new Database(new BoxRepository($this->pdo));
    }

    public function getShipment(): Database
    {
        return new Database(new ShipmentRepository($this->pdo));
    }

    public function getShipmentBox(): Database
    {
        return new Database(new ShipmentBoxRepository($this->pdo));
    }
}