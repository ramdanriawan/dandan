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
        return $this->getQuery();
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
        parent::setTable($var);
    }

    public function __call($methodName, $arguments)
    {
        
    }
}
