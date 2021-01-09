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

	function getUser() { 
 		return $this->user; 
	} 

	function setUser($user) {  
		$this->user = $user; 
	} 

	function getPassword() { 
 		return $this->password; 
	} 

	function setPassword($password) {  
		$this->password = $password; 
	} 

	function getDb() { 
 		return $this->db; 
	} 

	function setDb($db) {  
		$this->db = $db; 
	} 
