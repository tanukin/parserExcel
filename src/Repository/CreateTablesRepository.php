<?php

namespace App\Repository;

use Exception;

class CreateTablesRepository
{
    private $pdo;

    private $tables = ['shipments', 'boxes'];

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(): void
    {
        foreach ($this->tables as $table) {
            if (!$this->hasTable($table)) {
                $this->createTable($table);
            }
        }

        if (!$this->hasTable('box_shipment')) {
            $this->createBoxShipment();
        }
    }

    private function hasTable($tableName): bool
    {
        try {
            $result = $this->pdo->query("SELECT 1 FROM $tableName LIMIT 1");
        } catch (Exception $e) {
            return false;
        }

        return $result !== false;
    }

    private function createTable($tableName): void
    {
        $this->pdo->exec("CREATE TABLE $tableName (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(50) NOT NULL UNIQUE                       
                );");
    }

    private function createBoxShipment(): void
    {
        $this->pdo->exec("CREATE TABLE box_shipment (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    shipment_id int(10) UNSIGNED NOT NULL,
                    box_id int(10) UNSIGNED NOT NULL,
                    FOREIGN KEY (shipment_id)  REFERENCES shipments (id) ON DELETE CASCADE,                 
                    FOREIGN KEY (box_id)  REFERENCES boxes (id) ON DELETE CASCADE                      
                );");
    }
}