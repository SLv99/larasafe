<?php namespace Hernandes\Larasafe;


use \Config;


class Manager
{

    private $database;

    public function __construct(Parser\Database $db = null)
    {

        print_r($db);

        //$this->files        = Config::get('larasafe::files');
        //$this->targets      = Config::get('larasafe::targets');
    }

    public function getDatabaseConfig()
    {
        return $this->database;
    }

    public function getFilesConfig()
    {
        return $this->files;
    }

    public function getTargetsConfig()
    {
        return $this->targets;
    }
} 