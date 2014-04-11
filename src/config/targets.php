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
    | Local Target
    |--------------------------------------------------------------------------
    |
    | A Place to store local copies of the the backup
    | Please specify a complete path to the target
    | relative paths can be messy to find latter
    |
	*/

    'local' => app_path().'app/storage/backups',



    /*
    |--------------------------------------------------------------------------
    | Remote Target
    |--------------------------------------------------------------------------
    |
    | @todo include a remote target option, it will add the rsync or scp dependency
    |
    |
    */



);