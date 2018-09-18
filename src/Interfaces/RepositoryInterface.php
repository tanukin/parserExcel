<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function saveAll(array $arrayBox): bool;
}