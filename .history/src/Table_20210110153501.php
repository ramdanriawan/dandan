<?php 

namespace RamdanRiawan;

class Table extends Condition
{
    public $tables = [];

    public function getTables()
    {
        $this->setQuery("SHOW TABLES")->setStatement();
        $this->results = $this->statement->fetchAll();

        foreach ($this->results as $result) {

            $this->tables[]    = array_values(json_decode(json_encode($result), true))[0];
        }

        return $this->tables;
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

    public function find($value)
    {
        $primaryKey = parent::getPrimaryKey();
        die("SELECT * FROM $this->table where {$primaryKey}='$value'");
        $this->setQuery("SELECT * FROM $this->table where {$primaryKey}='$value'")->setStatement();
        
        return isset($this->statement->fetchAll()[0]) ? $this->statement->fetchAll()[0] : null;
    }

    public function where($column, $value)
    {
        $this->setQuery("SELECT * FROM $this->table where {$column}='$value'")->setStatement();
        
        return $this->statement->fetchAll();
    }

    public function row($column, $value)
    {
        $this->setQuery("SELECT * FROM $this->table where {$column}='$value'")->setStatement();
        
        return isset($this->statement->fetchAll()[0]) ? $this->statement->fetchAll()[0] : null;
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
        
        return parent::setTable($var)->setLoop()->setAttributes();
    }

    public function __call($methodName, $arguments)
    {

        return parent::setTable($methodName)->setLoop()->setAttributes();
    }

    public function __invoke($x = 0)
    {

        return parent::all();
    }
}