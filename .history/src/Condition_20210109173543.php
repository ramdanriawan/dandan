<?php 

namespace RamdanRiawan;

class Condition extends Query
{
    private $condition = []; 

    public function addCondition($condition)
    {
        $this->condition[] = $condition;

        return $this;
    }

    public function getCondition()
    {
        
        return $this->condition;
    }

    public function where($column, $value)
    {
        $this->addCondition("$column = '$value'");

        return $this;
    }

    public function lt($column, $value)
    {
        $this->addCondition("$column < '$value'");
        
        return $this;
    }

    public function gt($column, $value)
    {
        $this->addCondition("$column > '$value'");
        
        return $this;
    }
    
    public function in($column, $values)
    {
        $values = array_map(function($item) {

            return "'$item'";
        }, $values);

        $values = implode(",", $values);

        $this->addCondition("$column in ($values)");

        return $this;
    }

    public function notIn($column, $values)
    {
        $values = array_map(function($item) {

            return "'$item'";
        }, $values);

        $values = implode(",", $values);

        $this->addCondition("$column not in ($values)");

        return $this;
    }

    public function notNull($column)
    {

        $this->addCondition("$column not null");

        return $this;
    }

    public function or($columnAndValues)
    {
        $or = [];
        foreach ($columnAndValues as $key => $item) {
            $or[] = "$key = '$item'";
        }

        $or = implode(' or ', $or);

        $this->addCondition($or);

        return $this;
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

        $this->addCondition($and);

        return $this;
    }

    public function between($column, $values)
    {
        
        $this->addCondition("$column between $values[0] and $values[1]");

        return $this;
    }

    public function like($column, $value)
    {

        $this->addCondition("$column like '%$value%'");

        return $this;
    }

    public function not($column, $value)
    {

        $this->addCondition("$column not $value");

        return $this;
    }

    public function buildQuery()
    {
        
        return implode(" and ", $this->getCondition());
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

    public function __destruct()
    {

        return (new parent)->setQuery($this->buildQuery()); 
    }
}
