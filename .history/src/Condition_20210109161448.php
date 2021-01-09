<?php 

namespace RamdanRiawan;

class Condition
{
    private $condition = ""; 

    public function addCondition($c)
    {

    }

    public function where($column, $value)
    {

        return $this->"$column = '$value'";
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

    public function or($columnAndValues)
    {
        $or = [];
        foreach ($columnAndValues as $key => $item) {
            $or[] = "$key = '$item'";
        }

        $or = implode(' or ', $or);

        return $or;
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
        $and = [];
        foreach ($columnAndValues as $key => $item) {
            $and[] = "$key = '$item'";
        }

        $and = implode(' and ', $and);

        return $and;
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
