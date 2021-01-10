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
    public $loop = 0;

    public function inject($item)
    {
        foreach ($this->getAttributes() as $attribute) {

            $this->$attribute = $item->$attribute;
        }

        // pengaturan relasi yang sudah di deifinisikan
        foreach(parent::getRelations()[$this->table] as $name => $relation) {
// echo($relation[1]);
            $this->$name = clone $this;
            
            // # 0 table, 1 column, 2 jenis relasi
            // $this->$name->setTable($relation[0])->setLoop()->setAttributes();
        }

        // pengaturan looping setiap data
        $this->loop += 1;

        return clone $this;
    }

    public function getLoop()
    {

        return $this->loop += 1;
    }

    public function setLoop()
    {
        $this->loop = 0;

        return $this;
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
        $database = parent::getDb();

        $this->setQuery("SELECT
        TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
      FROM
        INFORMATION_SCHEMA.KEY_COLUMN_USAGE
      WHERE
        REFERENCED_TABLE_SCHEMA = '$database' AND
        REFERENCED_TABLE_NAME = '$this->table'")->setStatement();
        
        return $this->foreigns = $this->getStatement()->fetchAll();
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

    public function getEnum($column)
    {
        $this->setQuery("SHOW COLUMNS FROM {$this->table} WHERE Field = '{$column}'")->setStatement();

        $this->results = $this->statement->fetchAll()[0];

        preg_match("/^enum\(\'(.*)\'\)$/", $this->results->Type, $matches);

        return explode("','", $matches[1]);
    }

    public function getEnums()
    {
        foreach($this->getAttributes() as $attribute) {
            $this->setQuery("SHOW COLUMNS FROM {$this->table} WHERE Field = '{$attribute}'")->setStatement();

            $this->results = $this->statement->fetchAll()[0];

            if(preg_match("/^enum\(\'(.*)\'\)$/", $this->results->Type, $matches)) {

                $this->enums[] = explode("','", $matches[1]);
            }
        }
        
        return $this->enums;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function getColumn($column)
    {
        foreach($this->getColumns() as $columnDesc) {

            if($columnDesc->Field == $column) return $columnDesc;
        }
    }

    public function getColumns()
    {
        $this->setQuery("DESC $this->table")->setStatement();

        return $this->columns = $this->statement->fetchAll();
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
        $this->setQuery("truncate $this->table")->setStatement();

        return true;
    }

    public function drop()
    {
        $this->setQuery("drop table $this->table")->setStatement();

        return true;
    }

    public function getConnection()
    {

        return parent::getConnection();
    }

    public function __call($methodName, $arguments)
    {
        
    }

    

}
