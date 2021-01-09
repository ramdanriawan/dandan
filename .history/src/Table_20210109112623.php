<?php 

namespace RamdanRiawan;

class Table
{
    private $table;
    private $tables;
    private $primaryKey;
    private $tablePrefix;
    private $foreigns;
    private $uniques;
    private $enum;
    private $enums;
    private $defaults;
    private $column;
    private $columns;
    private $columnCount;

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function getTables()
    {
        return $this->tables;
    }

    public function setTables($tables)
    {
        $this->tables = $tables;
        
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        
        return $this;
    }

    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    public function setTablePrefix($tablePrefix)
    {
        $this->tablePrefix = $tablePrefix;
        
        return $this;
    }

    public function getForeigns()
    {
        return $this->foreigns;
    }

    public function setForeigns($foreigns)
    {
        $this->foreigns = $foreigns;
        
        return $this;
    }

    public function getUniques()
    {
        return $this->uniques;
    }

    public function setUniques($uniques)
    {
        $this->uniques = $uniques;
        
        return $this;
    }

    public function getEnum()
    {
        return $this->enum;
    }

    public function setEnum($enum)
    {
        $this->enum = $enum;
        
        return $this;
    }

    public function getEnums()
    {
        return $this->enums;
    }

    public function setEnums($enums)
    {
        $this->enums = $enums;
        
        return $this;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
        
        return $this;
    }

    public function getColumn()
    {
        return $this->column;
        
        return $this;
    }

    public function setColumn($column)
    {
        $this->column = $column;
        
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
        
        return $this;
    }

    public function setColumns($columns)
    {
        $this->columns = $columns;
        
        return $this;
    }

    public function getColumnCount()
    {
        return $this->columnCount;
        
        return $this;
    }

    public function setColumnCount($columnCount)
    {
        $this->columnCount = $columnCount;
        
        return $this;
    }

    public function transaction($func) 
    {

    }

    public function truncate()
    {

    }

    public function drop()
    {

    }

    public function getDb()
    {
        
    }

    public function __call($methodName, $arguments)
    {

        
    }

}