<?php

namespace App\Services;

use App\Repository\BoxRepository;

class BoxService
{
    /**
     * @var BoxRepository
     */
    private $repository;

    public function __construct(BoxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $array): bool
    {
        return $this->repository->saveAll($array);
    }
}