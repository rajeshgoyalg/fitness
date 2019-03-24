<?php

namespace Api\Config;

class Connection
{
    private $driver;
    private $host;
    private $dbName;
    private $username;
    private $password;
    public  $connection = NULL;

    public function __construct(array $config)
    {
        $this->driver   = $config['db']['driver'];
        $this->host     = $config['db']['host'];
        $this->dbName   = $config['db']['dbname'];
        $this->username = $config['db']['username'];
        $this->password = $config['db']['password'];
    }

    public function openConnection()
    {
        $server = $this->driver . ':host=' . $this->host . ';dbname=' . $this->dbName;

        try {
            $this->connection = new \PDO($server, $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'There is some problem in connection: ' . $e->getMessage();
        }

        return $this->connection;
    }

    public function __destruct()
    {
        $this->connection = NULL;
    }
}