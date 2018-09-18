<?php

namespace App\Repository;

use App\Entities\Box;
use PDO;

class BoxRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveAll(array $arrayBox): bool
    {
        $sth = $this->pdo->prepare('INSERT INTO boxes (id, name) VALUES (:id, :name)');

        foreach ($arrayBox as $box) {
            if ($box instanceof Box) {
                $sth->bindValue(':id', $box->getId(), PDO::PARAM_INT);
                $sth->bindValue(':name', $box->getName(), PDO::PARAM_STR);
                $sth->execute();
            }
        }

        return true;
    }
}