<?php

namespace RamdanRiawan;

class Model extends Connection
{
    public $table;
    public $primaryKey;
    public $tablePrefix;
    public $foreigns;
    public $uniques;
    public $enum;
    public $enums;
    public $defaults;
    public $column;
    public $columns;
    public $columnCount;
    public $attributes;
    public $loop;

    public function getLoop()
    {

        return $this->loop += 1;
    }

    public function setLoop()
    {
        $this->loop = 0;
    }

    public function setAttributes()
    {
        $this->setQuery("DESC $this->table")->setStatement();
        $this->results = $this->getStatement()->fetchAll();

        $attributes = [];
        foreach ($this->results as $result) {

            $attributes[] = $result->Field;
        }

        $this->attributes = $attributes;

        return $this;
    }

    public function getAttributes()
    {

        return $this->attributes;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;

        $primaryKey = preg_replace("/data_/", "id_", $table);

        $this->setPrimaryKey($primaryKey);
        $this->setTablePrefix('data_');

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
        $this->setQuery("SELECT count(*) as columnCount FROM information_schema.`COLUMNS` C WHERE table_name = '$this->table' AND TABLE_SCHEMA = '" . parent::getDb() . "'")->setStatement();

        return $this->getStatement()->fetchAll()[0]->columnCount;
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

    public function getConnection()
    {

        return parent::getConnection();
    }

    public function __call($methodName, $arguments)
    {

    }

}
