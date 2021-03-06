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

    public function __construct()
    {
        $this->fileConfig = Config::get('larasafe::targets');
        $this->parse();
    }

    /**
     *
     */
    protected function parse()
    {
        $this->local = in_array('local', $this->fileConfig['modes']);
        $this->remote = in_array('remote', $this->fileConfig['modes']);
        $this->versions = $this->fileConfig['versions'];

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

    /**
     * @return bool
     */
    public function localEnabled()
    {
        return $this->local;
    }

    /**
     * @return bool
     */
    public function remoteEnabled()
    {
        return $this->remote;
    }

    /**
     * @return mixed
     */
    public function getLocalPath()
    {
        return $this->localPath;
    }

    /**
     * @return mixed
     */
    public function getRemoteConnection()
    {
        return $this->remoteConnection;
    }

    /**
     * @return mixed
     */
    public function getRemotePath()
    {
        return $this->remotePath;
    }

    /**
     * @return mixed
     */
    public function getSshKeyPath()
    {
        return $this->sshKeyPath;
    }


    /**
     * @return array
     */
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