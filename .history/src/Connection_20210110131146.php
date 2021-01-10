<?php

namespace RamdanRiawan;

use PDO;
use PDOException;

class Connection
{
    public $host;
    public $user;
    public $password;
    public $db;
    public $relations;
    public $tablePrefix;
    public $connection;

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

    public function setTablePrefix($prefix)
    {
        $this->tablePrefix = $prefix;
        
        return $this;
    }

    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

}