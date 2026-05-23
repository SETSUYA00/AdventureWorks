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

        // ONLY use MySQL if running on Railway (where MYSQLHOST is set)
        $railwayHost = $_ENV['MYSQLHOST'] ?? getenv('MYSQLHOST');
        
        if ($railwayHost) {
            $this->default['hostname'] = $railwayHost;
            $this->default['username'] = $_ENV['MYSQLUSER'] ?? getenv('MYSQLUSER');
            $this->default['password'] = $_ENV['MYSQLPASSWORD'] ?? getenv('MYSQLPASSWORD');
            $this->default['database'] = $_ENV['MYSQLDATABASE'] ?? getenv('MYSQLDATABASE');
            $this->default['port']     = (int) ($_ENV['MYSQLPORT'] ?? getenv('MYSQLPORT') ?: 3306);
            $this->default['DBDriver'] = 'MySQLi'; // Switch driver to MySQL for Railway
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}