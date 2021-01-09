<?php

namespace RamdanRiawan;

class DB
{
    private $host;
    private $user;
    private $password;
    private $db;

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }
}
