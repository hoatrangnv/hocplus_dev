<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mysql_contest',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
        'mysql_core' => [
            'driver' => 'mysql',
            'host' => explode(',', env('DB_HOST')),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
            'prefix' => '',
            'strict' => true,
        ],

        'mysql_contest' => [
            'driver' => 'mysql',
            'host' => explode(',', env('DB1_HOST')),
            'port' => env('DB1_PORT'),
            'database' => env('DB1_DATABASE'),
            'username' => env('DB1_USERNAME'),
            'password' => env('DB1_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
            'prefix' => '',
            'strict' => true,
        ],

        'mysql_cuocthi' => [
            'driver' => 'mysql',
            'host' => explode(',', env('DB1_HOST')),
            'port' => env('DB1_PORT'),
            'database' => env('DB1_DATABASE'),
            'username' => env('DB1_USERNAME'),
            'password' => env('DB1_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
            'prefix' => '',
            'strict' => true,
        ],

        'mongodb' => [
            'driver'   => 'mongodb',
            'host'     => '123.30.187.165',
            'port'     => 27017,
            'database' => 'vne_contest',
            'username' => 'vne_contest',
            'password' => 'jY2acnt3SUf5JyCw',
            'options' => [
                'database' =>  'vne_contest'
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', 'redis'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
