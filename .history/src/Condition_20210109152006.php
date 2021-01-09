<?php 

namespace RamdanRiawan;

class Condition
{
    private $condition; 
    
    public function where($column, $value)
    {
        return "$column = '$value'";
    }

    public function lt($column, $value)
    {
        return "$column < '$value'";
    }

    public function gt($column, $value)
    {
        return "$column > '$value'";
    }
    
    public function in($column, $values)
    {
        $values = array_map(function($item) {

            return "'$item'";
        }, $values);

        $values = implode(",", $values);

        return "$column in ($values)";
    }

    public function notIn($column, $values)
    {
        $values = array_map(function($item) {

            return "'$item'";
        }, $values);

        $values = implode(",", $values);

        return "$column not in ($values)";
    }

    public function notNull($column)
    {

        return "$column not null";
    }

    public function or($data)
    {
        
    }
    
    public function and()
    {
        
    }

    public function between()
    {
        
    }

    public function like()
    {
        
    }

    public function not()
    {
        
    }

    public function buildQuery()
    {
        
    }

    public function getSelect()
    {
        
    }

    public function getUpdate()
    {
        
    }

    public function getDelete()
    {
        
    }
}
