<?php

namespace RamdanRiawan;

use PDO;
use PDOException;

class DB
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

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // langsung tambahkan table otomatis dari databas yang udah ditentukan diatas
            $this->autoAddTables();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function disconnect()
    {
        
    }

    public function backup()
    {
        
    }

    public function info()
    {
        
    }
}
