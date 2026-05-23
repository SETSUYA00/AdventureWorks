<?php

namespace Config;

use CodeIgniter\Database\Config as DatabaseConfig;

class Database extends DatabaseConfig
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'ci4',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
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

        // Dynamically set database credentials from environment variables
        $this->default['hostname'] = env('database.default.hostname') ?: getenv('MYSQLHOST') ?: $this->default['hostname'];
        $this->default['username'] = env('database.default.username') ?: getenv('MYSQLUSER') ?: $this->default['username'];
        $this->default['password'] = env('database.default.password') ?: getenv('MYSQLPASSWORD') ?: $this->default['password'];
        $this->default['database'] = env('database.default.database') ?: getenv('MYSQLDATABASE') ?: $this->default['database'];
        $this->default['port']     = (int) (env('database.default.port') ?: getenv('MYSQLPORT') ?: $this->default['port']);

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}