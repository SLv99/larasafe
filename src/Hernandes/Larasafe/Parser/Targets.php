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

    protected $sshKeyPath;

    protected $backupEmail;

    protected $backupEmailSubject;

    protected $backupEmailView;

    protected $backupEmailFrom;

    protected $backupEnvironment;

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
        $this->backupEnvironment      = $this->fileConfig['backup_environment'];

        if ($this->localEnabled()) {
            
            $this->localPath    = $this->fileConfig['local_path'];
            
            $this->backupEmail          = $this->fileConfig['backup_email'];
            $this->backupEmailSubject   = $this->fileConfig['backup_email_subject'];
            $this->backupEmailView      = $this->fileConfig['backup_email_view'];
            $this->backupEmailFrom      = $this->fileConfig['backup_email_from'];
        }
        
        if ($this->remoteEnabled()) {
            $this->remoteConnection = $this->fileConfig['remote_connection'];
            $this->remotePath = $this->fileConfig['remote_path'];
            $this->sshKeyPath = $this->fileConfig['remote_ssh_key_path'];
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

    public function getSshKeyPath()
    {
        return $this->sshKeyPath;
    }

    public function getEnvironment()
    {
        return $this->backupEnvironment;
    }

    public function getBackupEmailData()
    {
        return array (
            'email'     => $this->backupEmail,
            'subject'   => $this->backupEmailSubject,
            'view'      => $this->backupEmailView,
            'from'      => $this->backupEmailFrom
        );
    }

} 