<?php 

namespace RamdanRiawan;

class Table
{
    public function autoAddTables()
    {
        $this->setQuery("SHOW TABLES")->setStatement();
        $this->results = $this->statement->fetchAll();

        $tables = [];

        foreach ($this->results as $result) {

            $table    = preg_replace("/$this->tablePrefix/", '', array_values(json_decode(json_encode($result), true))[0]);
            $tables[] = $table;
        }

        // cek jika kosong maka gagal koneksikan database
        if (!count($tables)) {

            die("Databases has no table");
        }

        // buat class tersendiri untuk setiap table
        foreach ($tables as $table) {

            $this->$table = clone $this;
            $this->$table->setTable($table);
        }

        $this->tables = $tables;

        return $this;
    }
}
