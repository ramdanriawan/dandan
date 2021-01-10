<?php 

namespace RamdanRiawan;

use PDO;
use RamdanRiawan\Condition;

class Query extends Model
{
    public $query;
    public $statement;

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
        try {
            $this->statement = $this->connection->prepare($this->query);
            $this->statement->execute();
            $this->statement->setFetchMode(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
        
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
    {}

    # select method list
    public function select()
    {
        
    }

    public function setRelation($results)
    {
        $models = [];
        foreach($results as $item) {

            $models[] = parent::inject($item);
        }

        foreach($models as $index => $model) {

            $only = parent::getAttributes();
            array_push($only, 'loop');

            foreach($model as $indexItem => $item) {
                if(!in_array($indexItem, $only)) {

                    unset($models[$index]->$indexItem);
                }
            }
        }

        foreach($models as $index => $model) {
            foreach(parent::getRelation() as $relationName => $relationSetting) 
            {
                $relation = clone $this;

                $relation->setTable($relationSetting['table'])->setLoop()->setAttributes();
                
                if($relationSetting['relation_name'] == 'belongstoone') {
                    $models[$index]->$relationName = $relation->inject($relation->find($this->{$relationSetting['column']}));
                    
                } else if($relationSetting['relation_name'] == 'hastomany') {
                    $models[$index]->$relationName = $relation->inject($relation->where($relationSetting['column'], $model->{$this->primaryKey}));
                } else if($relationSetting['relation_name'] == 'hastoone') {
                    $models[$index]->$relationName = $relation->inject($relation->row($relationSetting['column'], $model->{$this->primaryKey}));
                    
                }
            }
        }

        return $models;
    }

    public function all()
    {
        $this->setQuery("select * from $this->table")->setStatement();

        return $this->setRelation($this->statement->fetchAll());
    }
    
    public function count()
    {
        
        return count($this->results);
    }

    public function distinct($column)
    {
        $this->setQuery("select distinct($column) from $this->table")->setStatement();

        return $this->setRelation($this->statement->fetchAll());
    }

    public function min($column)
    {
        "select min($column) as min from {$this->getTable()}";

        return $this;
    }

    public function max($column)
    {
        "select max($column) as max from {$this->getTable()}";
        
        return $this;
    }

    public function avg($column)
    {
        "select avg($column) as $column from {$this->getTable()}";
        
        return $this;
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

    public function __get($var)
    {echo($var);
        return $var;

        return $this;
    }
}