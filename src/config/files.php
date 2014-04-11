<?php

return array(



    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | Enable or Disable Files and Directories Backups
    |
    */

    'enabled' => true,

    /*
	|--------------------------------------------------------------------------
	| Backup Sources
	|--------------------------------------------------------------------------
	|
	| What files and folders should i backup?
    |
	*/
    'sources' => array(
        'app/config',
        'public',
        'app/database/production.sqlite',
    ),


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





);