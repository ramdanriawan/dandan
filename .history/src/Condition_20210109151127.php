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
        return "$column = '$value'";
    }

    public function notIn()
    {
        
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
