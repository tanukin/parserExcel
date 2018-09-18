<?php

namespace App\Services;

use App\Repository\ShipmentRepository;

class ShipmentService
{
    /**
     * @var ShipmentRepository
     */
    private $repository;

    public function __construct(ShipmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $array): bool
    {
        return $this->repository->saveAll($array);
    }
}