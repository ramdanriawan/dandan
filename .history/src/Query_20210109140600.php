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
        
    }

    public function all()
    {
        
        return "select * from {$this->getTable()}";
    }
    
    public function count($column = "*")
    {
        return "select count($column) as $column from ";
    }

    public function distinct($column)
    {
        return "select distinct($column) as $column from ";
    }

    public function min($column)
    {
        return "select max($column) as $column from ";
    }

    public function max($column)
    {
        return "select max($column) as $column from ";
    }

    public function avg($column)
    {
        return "select avg($column) as $column from ";
    }

    public function sum($column)
    {
        return "select sum($column) as $column from ";
    }

    # update function list
    public function update()
    {
        return "update ";
    }

    public function updateBatch()
    {
        
    }

    public function updateOrCreate()
    {
        
    }

    public function increment()
    {
        
    }

    public function decrement()
    {
        
    }

    # delete function list
    public function delete()
    {
        
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