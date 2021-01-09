<?php 

namespace RamdanRiawan;

class DB
{
    private $host;

	function getHost() { 
 		return $this->host; 
	} 

	function setHost($host) {  
		$this->host = $host; 
	} 
}