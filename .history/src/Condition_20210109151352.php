<?php 

namespace RamdanRiawan;

class Condition
{
    public function where($column, $value)
    {
        return "$column = '$value'";
    }

    public function lt()
    {
        return "$column < '$value'";
    }

    public function gt()
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

        return "$column in ($values)";
    }

    public function notNull()
    {
        
    }

    public function or()
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
