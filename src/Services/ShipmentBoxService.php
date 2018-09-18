<?php

namespace App\Services;

use App\Repository\ShipmentBoxRepository;

class ShipmentBoxService
{
    /**
     * @var ShipmentBoxRepository
     */
    private $repository;

    public function __construct(ShipmentBoxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $array): bool
    {
        return $this->repository->saveAll($array);
    }
}