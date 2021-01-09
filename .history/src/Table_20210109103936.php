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
    }

    public function getTables()
    {
        return $this->tables;
    }

    public function setTables($tables)
    {
        $this->tables = $tables;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    public function setTablePrefix($tablePrefix)
    {
        $this->tablePrefix = $tablePrefix;
    }

    public function getForeigns()
    {
        return $this->foreigns;
    }

    public function setForeigns($foreigns)
    {
        $this->foreigns = $foreigns;
    }

    public function getUniques()
    {
        return $this->uniques;
    }

    public function setUniques($uniques)
    {
        $this->uniques = $uniques;
    }

    public function getEnum()
    {
        return $this->enum;
    }

    public function setEnum($enum)
    {
        $this->enum = $enum;
    }

    public function getEnums()
    {
        return $this->enums;
    }

    public function setEnums($enums)
    {
        $this->enums = $enums;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function setColumn($column)
    {
        $this->column = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    public function getColumnCount()
    {
        return $this->columnCount;
    }

    public function setColumnCount($columnCount)
    {
        $this->columnCount = $columnCount;
    }
}