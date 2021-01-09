<?php

namespace RamdanRiawan;

use PDO;
use PDOException;

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
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function setRelations($relations)
    {
        $this->relations = $relations;
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

    public function __call($methodName, $arguments)
    {
        if(method_exists(getcla, $methodName)) {

        }
    }
}
