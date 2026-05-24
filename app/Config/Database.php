<?php

namespace Config;

use CodeIgniter\Database\Config as DatabaseConfig;

class Database extends DatabaseConfig
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'      => '',
        'hostname' => 'DESKTOP-VKRMBR2\SQLEXPRESS',
        'username' => '',
        'password' => '',
        'database' => 'AdventureWorksDW2012',
        'DBDriver' => 'SQLSRV',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'trustServerCertificate' => true,
        'ReturnDatesAsStrings' => true,
        'failover' => [],
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }

        // Render Environment Override
        if (getenv('database.default.DBDriver') !== false || isset($_ENV['database.default.DBDriver']) || isset($_SERVER['database.default.DBDriver'])) {
            $this->default['DBDriver'] = getenv('database.default.DBDriver') ?: $_ENV['database.default.DBDriver'] ?? $_SERVER['database.default.DBDriver'] ?? 'MySQLi';
            $this->default['hostname'] = getenv('database.default.hostname') ?: $_ENV['database.default.hostname'] ?? $_SERVER['database.default.hostname'] ?? '';
            $this->default['username'] = getenv('database.default.username') ?: $_ENV['database.default.username'] ?? $_SERVER['database.default.username'] ?? '';
            $this->default['password'] = getenv('database.default.password') ?: $_ENV['database.default.password'] ?? $_SERVER['database.default.password'] ?? '';
            $this->default['database'] = getenv('database.default.database') ?: $_ENV['database.default.database'] ?? $_SERVER['database.default.database'] ?? '';
            $this->default['port']     = getenv('database.default.port') ?: $_ENV['database.default.port'] ?? $_SERVER['database.default.port'] ?? 3306;
        }
    }
}
