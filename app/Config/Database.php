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

        // Render/Linux Failsafe: switch to MySQLi when sqlsrv is unavailable
        if (!extension_loaded('sqlsrv')) {
            $this->default['DBDriver'] = 'MySQLi';
            $this->default['hostname'] = getenv('DB_HOST') ?: '';
            $this->default['username'] = getenv('DB_USER') ?: '';
            $this->default['password'] = getenv('DB_PASS') ?: '';
            $this->default['database'] = getenv('DB_NAME') ?: '';
            $this->default['port']     = (int)(getenv('DB_PORT') ?: 3306);
        }
    }
}
