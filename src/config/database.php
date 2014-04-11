<?php

return array(



    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | Enable or Disable Database Backups
    |
    */

    'enable' => 'true',




    /*
    |--------------------------------------------------------------------------
    | Connection
    |--------------------------------------------------------------------------
    |
    | What connection should i used to connection with your database?
    |
    | use the same names as specified on app/config/database.php
    |                                 or app/config/{env}/database.php
    |
    |
    */

    'connection' => 'mysql',




    /*
    |--------------------------------------------------------------------------
    | Excludes
    |--------------------------------------------------------------------------
    |
    | Exclude a table from being backed-up
    |
    */

    'excludes' => array(
        'table1name',
        'table2name'
    ),


    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | In case of using MySQL, additional options to pass to mysqldump
    |
    |
    */

    'options' => array(
        'opt',
    ),








);