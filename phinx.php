<?php

// load our environment files - used to store credentials & configuration
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeders',
        ],
        'environments' =>
            [
                'default_database' => 'development',
                'default_migration_table' => 'migrations',
                'development'      =>
                    [
                        'adapter' => 'mysql',
                        'host' => $_ENV['DB_HOST'],
                        'name' => $_ENV['DB_NAME'],
                        'user' => $_ENV['DB_USER_NAME'],
                        'pass' => $_ENV['DB_PASSWORD'],
                        'port' => 3306,
                        'charset' => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                    ],
            ],
    ];
