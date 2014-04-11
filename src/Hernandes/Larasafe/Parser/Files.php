<?php namespace Hernandes\Larasafe\Parser;

use \DB;
use \Config;

class Files
{
    protected $fileConfig;

    protected $sources;

    protected $versions;

    protected $excludes;

    protected $enabled = false;

    public function __construct()
    {
        $this->fileConfig = Config::get('larasafe::files');

        if ($this->fileConfig['enabled']) {
            $this->enabled = true;
            $this->parse();
        }
    }

    protected function parse()
    {
        $this->sources = $this->fileConfig['sources'];
        $this->versions = $this->fileConfig['versions'];
        $this->excludes = $this->fileConfig['excludes'];
    }

    public function getSources()
    {
        return $this->sources;
    }

    public function getVersions()
    {
        return $this->versions;
    }

    public function getExcludes()
    {
        $tmpExcludes = "";
        if (count($this->excludes > 0)) {
            foreach($this->excludes as $exclude) {
                $tmpExcludes .= " --exclude '$exclude'";
            }

        }
        return $tmpExcludes;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

} 