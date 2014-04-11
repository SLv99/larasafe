<?php namespace Hernandes\Larasafe\Parser;

use \DB;
use \Config;

class Targets
{
    protected $fileConfig;

    protected $local = false;

    protected $remote = false;

    protected $localPath;

    protected $remoteConnection;

    protected $remotePath;

    public function __construct()
    {
        $this->fileConfig = Config::get('larasafe::targets');
        $this->parse();
    }

    protected function parse()
    {
        $this->local = in_array('local', $this->fileConfig['modes']);
        $this->remote = in_array('remote', $this->fileConfig['modes']);
        $this->versions = $this->fileConfig['versions'];

        if ($this->localEnabled()) {
            $this->localPath = $this->fileConfig['local_path'];
        }
        
        if ($this->remoteEnabled()) {
            $this->remoteConnection = $this->fileConfig['remote_connection'];
            $this->remotePath = $this->fileConfig['remote_path'];
        }
    }

    public function localEnabled()
    {
        return $this->local;
    }

    public function remoteEnabled()
    {
        return $this->remote;
    }

    public function getLocalPath()
    {
        return $this->localPath;
    }

    public function getRemoteConnection()
    {
        return $this->remoteConnection;
    }

    public function getRemotePath()
    {
        return $this->remotePath;
    }

} 