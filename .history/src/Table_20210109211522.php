<?php 

namespace RamdanRiawan;

class Table extends Condition
{
    public $tables = [];
    
    public function get()
    {
        return;
    }

    public function getTables()
    {
        $this->setQuery("SHOW TABLES")->setStatement();
        $this->results = $this->statement->fetchAll();

        $tables = [];

        foreach ($this->results as $result) {

            $table    = preg_replace("/$this->tablePrefix/", '', array_values(json_decode(json_encode($result), true))[0]);
            $tables[] = $table;
        }
    }

    public function setTables($tables)
    {
        $this->tables = $tables;
        
        return $this;
    }

    public function first()
    {
        
    }

    public function last()
    {
        
    }

    public function limit()
    {
        
    }

    public function orderBy()
    {
        
    }

    public function groupBy()
    {
        
    }

    public function find()
    {
        
    }

    public function findOrFail()
    {
        
    }

    public function getFirstId()
    {
        
    }

    public function getLastId()
    {
        
    }

    public function getCondition()
    {

    }

    public function __get($var)
    {
        
        return parent::setTable($var);
    }

    public function __call($methodName, $arguments)
    {
        
        return parent::setTable($methodName);
    }
}
