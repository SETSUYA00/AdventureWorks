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

        // Render Environment Override / Linux Failsafe
        if (getenv('RENDER') || !extension_loaded('sqlsrv')) {
            $this->default['DBDriver'] = 'MySQLi';
            
            $host = getenv('database.default.hostname') ?: getenv('database_default_hostname');
            if ($host) $this->default['hostname'] = $host;
            
            $user = getenv('database.default.username') ?: getenv('database_default_username');
            if ($user) $this->default['username'] = $user;
            
            $pass = getenv('database.default.password') ?: getenv('database_default_password');
            if ($pass) $this->default['password'] = $pass;
            
            $db = getenv('database.default.database') ?: getenv('database_default_database');
            if ($db) $this->default['database'] = $db;
            
            $port = getenv('database.default.port') ?: getenv('database_default_port');
            if ($port) $this->default['port'] = $port;
        }
    }
}
