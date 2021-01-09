<?php

namespace RamdanRiawan;

use PDO;
use PDOException;

use function PHPSTORM_META\argumentsSet;

class DB extends Table
{
    private $host;
    private $user;
    private $password;
    private $db;
    private $relations;

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        
        return $this;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function setRelations($relations)
    {
        $this->relations = $relations;
        
        return $this;
    }
    
    public function getConnection()
    {
        return $this->connection;
    }

    public function setConnection()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die( "Connection failed: " . $e->getMessage());
        }
        
        return $this;
    }

    public function disconnect()
    {
        $this->connection = null;
    }

    public function backup()
    {
        
        
    }

    public function info()
    {

        
    }
    
    public function getTables()
    {
        return $this->tables;
    }

    public function setTables($tables)
    {
        $this->tables = $tables;
        
        return $this;
    }

    public function __get($var)
    {
        
        return (new parent())->setTable($var);
    }

    public function __call($methodName, $arguments)
    {

        return (new parent())->setTable($methodName);
    }
}