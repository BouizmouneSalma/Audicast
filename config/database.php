<?php
return [
    'driver' => 'pgsql',
    'host' => 'localhost',
    'port' => 5432,
    'database' => 'Spotify',
    'username' => 'postgres', 
    'password' => '1234', 
    'charset' => 'utf8',
    'schema' => 'public',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];