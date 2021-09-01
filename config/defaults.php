<?php

// Configure defaults for the whole application.

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('America/Recife');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['template'] = $settings['root'] . '/templates';

// Error handler
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => true,
    // Should be set to false for unit tests
    'log_errors' => true,
    // Display error details in error log
    'log_error_details' => true,
];

// Logger settings
$settings['logger'] = [
    'name' => 'app',
    'path' => $settings['root'] . '/logs',
    'filename' => 'app.log',
    'level' => \Monolog\Logger::DEBUG,
    'file_permission' => 0775,
];

// Database settings
$settings['db'] = [
    'driver' => 'pdo_pgsql',
    'host' => 'localhost',
    'dbname' => 'queryPerformance',
    'user' => 'postgres',
    'password' => '',
    //'charset' => 'utf8mb4',
    //'collation' => 'utf8mb4_unicode_ci',
    'driverOptions' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
    /*
    'driver' => "pdo_pgsql",
    'host' => 'localhost',
    'dbname' => 'db',
    'username' => 'postgres',
    'password' => 'root',
    //'encoding' => 'utf8mb4',
    //'collation' => 'utf8mb4_unicode_ci',
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Set to null to use MySQL servers timezone
    'timezone' => null,
    // Disable meta data cache
    'cacheMetadata' => false,
    // Disable query logging
    'log' => false,
    // PDO options
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Convert numeric values to strings when fetching.
        // Since PHP 8.1 integers and floats in result sets will be returned using native PHP types.
        // This option restores the previous behavior.
        PDO::ATTR_STRINGIFY_FETCHES => true,
    ],*/
];

// Phoenix settings
$settings['phoenix'] = [
    'migration_dirs' => [
        'first' => __DIR__ . '/../resources/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'pgsql',
            'host' => '127.0.0.1',
            'port' => 5432,
            'username' => 'postgres',
            'password' => 'root',
            'db_name' => 'queryPerformance',
            'charset' => 'utf8',
        ],
       
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];

// Console commands
$settings['commands'] = [
    \App\Console\SchemaDumpCommand::class,
    \App\Console\GenerateData::class,
];

return $settings;
