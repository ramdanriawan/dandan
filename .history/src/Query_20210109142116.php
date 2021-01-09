<?php 

namespace RamdanRiawan;

use PDO;
use RamdanRiawan\Condition;

class Query extends Condition
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

        return $this;
    }

    public function getStatement()
    {
        return $this->statement;
    }

    public function setStatement()
    {
        
        return $this;
    }

    public function makeColumn($column)
    {
        
        $column = array_map(function ($column) {

            return $column;
        }, $column);

        return '(' . implode(',', $column) . ')';
    
    }

    public function makeValues($values)
    {
        
        $valuesReturn = [];

        // foreach($values as $value)
        // {
        $values = array_map(function ($value) {

            return "'$value'";
        }, $values);

        $valuesReturn[] = '(' . implode(',', $values) . ')';
        // }

        return implode(',', $valuesReturn);
    }

    public function makeQueryInsert($data)
    {
        $column = $this->makeColumn(array_keys($data));
        $values = $this->makeValues(array_values($data));

        return "INSERT INTO $this->table $column values $values";
    }

    public function makeQueryUpdate($data)
    {
        $column = $this->makeColumn(array_keys($data));
        $values = $this->makeValues(array_values($data));

        $updates = [];
        foreach ($data as $column => $value) {
            $updates[] = "$column='$value'";
        }

        $updates = implode(',', $updates);

        if ($where) {

            return "UPDATE $this->table SET $updates where $where";
        }

        return "UPDATE $this->table SET $updates";
    }

    # select method list
    public function select()
    {
        
        return $this;
    }

    public function all()
    {
        
        return "select * from {$this->getTable()}";
    }
    
    public function count($column = "*")
    {
        return "select count($column) as count from {$this->getTable()}";
    }

    public function distinct($column)
    {
        return "select distinct($column) as distinct from  {$this->getTable()}";
    }

    public function min($column)
    {
        return "select min($column) as min from {$this->getTable()}";
    }

    public function max($column)
    {
        return "select max($column) as max from {$this->getTable()}";
    }

    public function avg($column)
    {
        return "select avg($column) as $column from {$this->getTable()}";
    }

    public function sum($column)
    {
        return "select sum($column) as sum from {$this->getTable()}";
    }

    # update function list
    public function update()
    {
        // $this->setQuery($this->makeQueryUpdate($data, $where))->setStatement();

        // return $this;
    }

    public function updateBatch()
    {
        
    }

    public function updateOrCreate()
    {
        
    }

    public function increment($column, $value = 1)
    {
        
        return "update {$this->getTable()} set $column = $column + $value";
    }

    // untuk mengurangi nilai suatu column
    public function decrement($column, $value = 1)
    {

        return "update {$this->getTable()} set $column = $column - $value";
    }

    # delete function list
    public function delete()
    {
        return "delete from {$this->getTable()}";
    }

    # insert function list
    public function insert($data)
    {
        // $this->query = $this->makeQueryInsert($data);
        // $this->setStatement();

        return $this;
    }

    public function insertBatch()
    {
        
    }

    public function getTable()
    {


    }
}