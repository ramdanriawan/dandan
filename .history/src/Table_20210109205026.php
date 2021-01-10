<?php 

namespace RamdanRiawan;

class Table extends Condition
{
    public function setQuery($query)
    {
        
        $this->query = $query;
    }

    public function getQuery()
    {

        return $this->query;
    }

    public function get()
    {
        return parent::getTable();
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

    public function __get($var)
    {
        
        return parent::setTable($var);
    }

    public function __call($methodName, $arguments)
    {
        
        return parent::setTable($methodName);
    }
}
