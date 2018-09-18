<?php

namespace App\Core;

use App\Interfaces\RepositoryInterface;

class Database
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $array): bool
    {
        return $this->repository->saveAll($array);
    }
}