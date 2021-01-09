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

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function and($columnAndValues)
    {

        foreach ($columnAndValues as $key => $item) {
            $columnAndValues[$index] =>
        }
    }

    public function between($column, $values)
    {
        
        return "$column between $values[0] and $values[1]";
    }

    public function like($column, $value)
    {

        return "$column like '%$value%'";
    }

    public function not($column, $value)
    {

        return "$column not $value";
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
