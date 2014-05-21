<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Backup all your files, including app ones?
    |--------------------------------------------------------------------------
    |
    | if true, any table configured in your models will be used.
    |
    */

    'modes' =>  array(
        'local',
        'remote'
    ),

    /*
    |--------------------------------------------------------------------------
    | Version to keep
    |--------------------------------------------------------------------------
    |
    | number of copies to keep
    | use 0 for unlimited
    |
    */

    'versions' => 4,



    /*
    |--------------------------------------------------------------------------
    | Local Target
    |--------------------------------------------------------------------------
    |
    | A Place to store local copies of the the backup
    | Please specify a complete path to the target
    | relative paths can be messy to find latter
    |
    */

    'local_path' => '/Volumes/web/backup',






    /*
    |--------------------------------------------------------------------------
    | Remote Target
    |--------------------------------------------------------------------------
    |
    | @todo include a remote target option, it will add the rsync or scp dependency
    |
    |
    */

    'remote_connection' => 'production',
    'remote_path'       => '/tmp',
    'remote_ssh_key_path'=> ''



);