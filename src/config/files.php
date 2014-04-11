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

    'all' =>  true,


    /*
    |--------------------------------------------------------------------------
    | Versions
    |--------------------------------------------------------------------------
    |
    | How many versions should i keep?
    |
    */

    'versions' =>  4,



    /*
    |--------------------------------------------------------------------------
    | Excludes
    |--------------------------------------------------------------------------
    |
    | Here you can exclude a folder or a file of being backed up
    |
    */

    'excludes' => array(
        'app/storage/cache',
        'app/storage/sessions',
        'app/storage/views',
    ),

    /*
    |--------------------------------------------------------------------------
    | Compression
    |--------------------------------------------------------------------------
    |
    | Do you wanna use another type of compression?
    |
    | Default: ZIP
    | Supported: tar.gz, tar.xz, zip, uncompressed
    |
    */

    'compression' => 'zip',



);