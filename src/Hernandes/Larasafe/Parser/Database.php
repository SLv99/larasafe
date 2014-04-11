<?php namespace Hernandes\Larasafe\Parser;

use \DB;
use \Config;

class Database
{
    protected $fileConfig;

    protected $connection;

    protected $options;

    protected $excludes;

    protected $dumpString;



    public function __construct()
    {
        $this->fileConfig = Config::get('larasafe::database');
        $this->parse();
    }

    protected function parse()
    {
        $this->parseConnection();
        $this->parseOptions();
        $this->parseExcludes();
        $this->generateDumpString();
        $this->getDumpString();
    }

    protected function parseConnection()
    {
        $connection_name = $this->fileConfig['connection'];
        $this->connection = \Config::get("database.connections.$connection_name");

    }

    protected function parseOptions()
    {
        $tmpOptions = "";
        if (count($this->fileConfig['options'] > 0)) {
            foreach($this->fileConfig['options'] as $opt) {
                $tmpOptions .= " --".$opt. " ";
            }

        }
        $this->options = $tmpOptions;

    }


    protected function parseExcludes()
    {
        $ignore_tables = "";
        if (count($this->fileConfig['excludes']) > 0) {
            foreach($this->fileConfig['excludes'] as $exclude) {
                $ignore_tables .= " --ignore-table=".$this->connection['database'].".".$exclude." ";
            }

        }
        $this->excludes = $ignore_tables;

    }


    protected function generateDumpString()
    {

        $password = '';
        if ($this->connection['password'] != '') {
            $password = '-p ' . $this->connection['password'];
        }
        $this->dumpString = "mysqldump -u".$this->connection['username']." "
                            . $password . " "
                            . $this->connection['database'] . " "
                            . $this->options . " "
                            . $this->excludes;



    }



    public function getDumpString()
    {
        return $this->dumpString;
    }



} 