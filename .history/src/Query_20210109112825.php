<?php 

namespace RamdanRiawan;

class Query
{
    private $query;
    private $statement;

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function getStatement()
    {
        return $this->statement;
    }

    public function setStatement($statement)
    {
        $this->statement = $statement;
    }

    public function makeColumn()
    {
        
    }
}