<?php
return [
    'default' => env('DB_CONNECTION', 'mongodb'),
    'connections' => [
        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ],
    ]
];
