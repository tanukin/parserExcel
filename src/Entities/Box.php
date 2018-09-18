<?php

namespace App\Entities;

class Box
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $id;

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}