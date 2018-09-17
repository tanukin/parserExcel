<?php

namespace App\Core;

use App\Exceptions\EmptyContentException;
use PDO;
use Symfony\Component\Yaml\Yaml;

class Connection
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return PDO
     *
     * @throws EmptyContentException
     */
    public function getConnect(): PDO
    {
        $settings = $this->getAllSettings();

        $connect = new PDO(
            sprintf("mysql:host=%s;dbname=%s", $settings["mysql"]["host"], $settings["mysql"]["dbname"]),
            $settings["mysql"]["user"],
            $settings["mysql"]["password"]
        );
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connect;
    }

    /**
     * @return mixed
     *
     * @throws EmptyContentException
     */
    protected function getAllSettings()
    {
        if (!file_exists($this->path))
            throw new EmptyContentException("Configuration file not found");

        $content = Yaml::parseFile($this->path);

        if (empty($content))
            throw new EmptyContentException("Configuration file is empty");

        return $content;
    }
}