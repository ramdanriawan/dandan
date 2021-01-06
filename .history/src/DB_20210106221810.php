<?php

namespace RamdanRiawan;

use PDO;

class DB
{
    # data PDO
    public $connection; // setiap data koneksi akan diatur disini
    public $statement; // setiap data statement pdo
    public $results; // digunakan untuk menampung results / data

    # data DB
    public $host; // host db misalnya localhost
    public $user; // user untuk mengakses db misalnya root
    public $password; // password untuk mengakses db misalnya root
    public $db; // db yang digunakan di program
    public $table; // table yang akan digunakan untuk query
    public $query; // query lengkap yang akan dieksekusi

    # data relasi
    public $relation = []; // untuk mengambil data relasi yang telah ditentukan

    # data table
    public $tables = [];
    public $primaryKey;
    public $tablePrefix = '';

    # data encrypt and decrypt
    public $key = 'qJB0rGtIn5UB1xG03efyCp';

    # tentang url
    public $basePath = "";

    # object lainnya
    public $carbon;
    public $arrayy;
    public $medoo;

    // ketika baru diinisialisasi harus di set dulu pengaturannya
    public function __construct($host, $user, $password, $db)
    {
        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
        $this->db       = $db;

        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // langsung tambahkan table otomatis dari databas yang udah ditentukan diatas
            $this->autoAddTables();

            // tambahkan object lain agar semakin mudah mengolah datanya
            // $this->carbon = new Carbon();
            // $this->arrayy = new Arrayy([]);
            // $this->medoo  = new Medoo([
            //     // required
            //     'database_type' => 'mysql',
            //     'database_name' => $this->db,
            //     'server'        => $this->host,
            //     'username'      => $this->user,
            //     'password'      => $this->password,

            //     // [optional]
            //     'charset'       => 'utf8mb4',
            //     'collation'     => 'utf8mb4_general_ci',
            //     'port'          => 3306,

            //     // [optional] Table prefix
            //     'prefix'        => 'data_',

            //     // [optional] Enable logging (Logging is disabled by default for better performance)
            //     'logging'       => false,

            //     // [optional] MySQL socket (shouldn't be used with server and port)
            //     'socket'        => '/tmp/mysql.sock',

            //     // [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            //     'option'        => [
            //         PDO::ATTR_CASE => PDO::CASE_NATURAL,
            //     ],

            //     // [optional] Medoo will execute those commands after connected to the database for initialization
            //     'command'       => [
            //         'SET SQL_MODE=ANSI_QUOTES',
            //     ],
            // ]);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this;
    }

    public function setTablePrefix($prefix)
    {
        $this->tablePrefix = $prefix;

        return $this;
    }

    public function getTablePrefix($prefix)
    {
        return $this->tablePrefix;
    }

    // fungsi untuk menambahkan  table otomatis setelah disetting
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

            die("Databases has not table");
        }

        // buat class tersendiri untuk setiap table
        foreach ($tables as $table) {

            $this->$table = clone $this;
            $this->$table->setTable($table);
        }

        $this->tables = $tables;

        return $this;
    }

    // untuk mendapatkan semua data tables yang ada didatabse
    public function getTables()
    {

        return $this->tables;
    }

    // setiap akan mengambil data dari table baru maka harus set table dan primary key dari table tersebut
    // relations digunakan untuk mengambil data relations
    public function setTable($table)
    {
        $this->table      = $table;
        $this->primaryKey = 'id_' . preg_replace('/data_/', '', $table);

        return $this;
    }

    // untuk mendapatkan nama table yang sedang digunakan
    public function getTable()
    {
        return $this->table;
    }

    // untuk mendapatkan primary key dari table yang sedang digunakan
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    // setiap query untuk proses data harus diset melalui function ini
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    // funngsi untuk mendapatkan query yang sedang digunakan
    public function getQuery()
    {

        return $this->query;
    }

    // fungsi untuk mengatur statement pdo sebelum di ambil datanya melalui fetch
    public function setStatement()
    {
        try {
            $this->statement = $this->connection->prepare($this->query);
            $this->statement->execute();
            $this->statement->setFetchMode(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    // fungsi yang akan sering digunakan untuk mengambil data
    public function get()
    {
        $this->setQuery("SELECT * FROM $this->table")->setStatement();

        $this->results = $this->statement->fetchAll();

        return $this;
    }

    // fungsi yang akan digunakan untk mencari data
    public function like($column, $like)
    {
        $results     = $this->get()->toArray();
        $resultLikes = [];

        foreach ($results as $position => $result) {
            if (preg_match("/$like/", $result[$column])) {

                $resultLikes[] = $this->results[$position];
            }
        }

        return count($resultLikes) ? $resultLikes : null;
    }

    ### list fungsi untuk mengelola data

    // fungsi untuk membalikkan data
    public function reverse()
    {
        $this->get();

        return array_reverse($this->results);
    }

    ### list fungsi untuk memfilter data

    // untuk mengambil semua data
    public function all()
    {
        $this->get();

        return $this->results;
    }

    // untuk mengambil data pertama
    public function first()
    {
        $this->get();

        return array_shift($this->results);
    }

    // untuk mengambil data terakhir
    public function last()
    {
        $this->get();

        return end($this->results);
    }

    // untuk mengambil data berdasarkan kondisi where satu buah saja
    public function where($column, $value)
    {
        $results      = $this->get()->toArray();
        $resultWheres = [];

        foreach ($results as $position => $result) {
            if ($result[$column] == $value) {

                $resultWheres[] = $this->results[$position];
            }
        }

        return count($resultWheres) ? $resultWheres : null;
    }

    // untuk mengambil data berdasarkan kondisi where satu column
    public function row($column, $value)
    {

        return $this->where($column, $value)[0];
    }

    // untuk mengambil data berdasarkan kondisi where in (data yg dicari berdasarkan beberapa nilai)
    public function whereIn($column, $values)
    {
        $results        = $this->get()->toArray();
        $resultWhereIns = [];

        foreach ($results as $position => $result) {

            foreach ($values as $value) {
                if ($result[$column] == $value) {

                    $resultWhereIns[] = $this->results[$position];
                }
            }
        }

        return count($resultWhereIns) ? $resultWhereIns : null;
    }

    // untuk mencari data berdasarkan kondisi whereAnd (data yg dicari di satu baris berdasarkan kondisi tertentu
    public function whereAnd($columnAndValues)
    {
        $results        = $this->get()->toArray();
        $resultWhereAnd = [];

        foreach ($results as $position => $result) {
            foreach ($columnAndValues as $column => $value) {
                if ($result[$column] != $value) {

                    continue 2;
                }

            }

            $resultWhereAnd[] = $this->results[$position];
        }

        return count($resultWhereAnd) ? $resultWhereAnd : null;
    }

    // untuk mencari data berdasarkan kondisi whereOr (data yg dicari di satu baris berdasarkan kondisi tertentu
    public function whereOr($columnAndValues)
    {
        $results       = $this->get()->toArray();
        $resultWhereOr = [];

        foreach ($results as $position => $result) {
            foreach ($columnAndValues as $column => $value) {
                if ($result[$column] == $value) {

                    $resultWhereOr[] = $this->results[$position];

                    continue 2;
                }
            }
        }

        return count($resultWhereOr) ? $resultWhereOr : null;
    }

    // untuk mencari data berdasarkan primaryKey
    public function find($primaryKey)
    {
        $results = $this->get()->toArray();

        foreach ($results as $position => $result) {
            if ($result[$this->primaryKey] == $primaryKey) {

                return $this->results[$position];
            }
        }

        return null;
    }

    // untuk menyeleksi berdasarkan kolom tertentu
    public function select($selectedColumns)
    {
        $results         = $this->get()->toArray();
        $resultSelecteds = [];

        foreach ($results as $position => $result) {
            $resultColumns = array_keys($result);

            foreach ($resultColumns as $resultColumn) {
                if (!in_array($resultColumn, $selectedColumns)) {
                    unset($result[$resultColumn]);

                }
            }

            $resultSelecteds[] = $result;
        }

        return count($resultSelecteds) ? $resultSelecteds : null;
    }

    ### list fungsi untuk mengatur relations antar table yang telah didefinisikan
    public function setRelations($foreigns)
    {
        // mengatur relasi
        // foreach ($foreigns as $foreign) {

        //     $table = preg_replace('/id_/', '', $foreign);

        //     $this->$table = new DB($this->host, $this->user, $this->password, $this->db);
        //     $this->$table->setTable('data_' . $table);
        //     // $this->$table = $this->$table->where($foreign, );
        // }
    }

    public function belongsTo($foreign, $value)
    {
        $tableRefference = 'data_' . preg_replace('/id_/', '', $foreign);

        $relation = new DB($this->host, $this->user, $this->password, $this->db);
        $relation->setTable($tableRefference);

        $relation = $relation->where($foreign, $value);

        return array_pop($relation);
    }

    public function hasOne($tableRefference, $value)
    {
        $primaryKey = 'id_' . preg_replace('/data_/', '', $tableRefference);

        $relation = new DB($this->host, $this->user, $this->password, $this->db);
        $relation->setTable($tableRefference);

        $relation = $relation->where($primaryKey, $value);

        return array_pop($relation);
    }

    public function hasMany($tableRefference, $value)
    {
        $primaryKey = 'id_' . preg_replace('/data_/', '', $tableRefference);

        $relation = new DB($this->host, $this->user, $this->password, $this->db);
        $relation->setTable($tableRefference);

        $relation = $relation->where($primaryKey, $value);

        return $relation;
    }

    ### list fungsi untuk konversi data ke object tertentu
    // fungsi untuk mengubah data ke array
    public function toArray()
    {
        $this->get();

        return json_decode(json_encode($this->results), true);
    }

    // fungsi untuk mengubah data ke json
    public function toJson()
    {
        $this->get();

        return json_encode(json_decode(json_encode($this->results), true));
    }

    // fungsi untuk mengubah ke xml
    public function toXml()
    {

    }

    ## fungsi untuk menginsert dan mengupdate data
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

    public function makeColumn($column)
    {
        $column = array_map(function ($column) {

            return $column;
        }, $column);

        return '(' . implode(',', $column) . ')';
    }

    public function makeQueryInsert($data)
    {
        $column = $this->makeColumn(array_keys($data));
        $values = $this->makeValues(array_values($data));
        // die("INSERT INTO $this->table $column values $values");
        return "INSERT INTO $this->table $column values $values";
    }

    public function makeQueryUpdate($data, $where)
    {
        $column = $this->makeColumn(array_keys($data));
        $values = $this->makeValues(array_values($data));

        $updates = [];
        foreach ($data as $column => $value) {
            $updates[] = "$column='$value'";
        }

        $updates = implode(',', $updates);

        if ($where) {

            return "UPDATE $this->table SET $updates where $where";
        }

        return "UPDATE $this->table SET $updates";
    }

    public function insert($data)
    {
        $this->query = $this->makeQueryInsert($data);
        $this->setStatement();

        return $this;
    }

    public function insertBatch($datas)
    {
        foreach ($datas as $data) {

            $this->insert($data);
        }

        return $this;
    }

    public function getLastId()
    {

        return $this->last()->{$this->primaryKey};
    }

    public function getFirstId()
    {

        return $this->first()->{$this->primaryKey};
    }

    public function update($data, $where = null)
    {
        // die($this->makeQueryUpdate($data, $where));
        $this->setQuery($this->makeQueryUpdate($data, $where))->setStatement();
        return $this;
    }

    public function updateBatch($datas, $where = null)
    {
        foreach ($datas as $data) {
            $this->update($data, $where);
        }
    }

    // membatasi data yang akan diambil
    public function limit($start, $end)
    {
        $this->get();

        return array_slice($this->results, $start, $end);
    }

    // mengurutkan data berdasarkan column tertentu secara asceding atau descending
    public function orderBy($column, $sort = 'ASC')
    {
        $this->setQuery("select * from $this->table order by $column $sort")->setStatement();
        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // jika ada update jika tidak ada buat baru datanya
    public function updateOrNew($where)
    {
    }

    // menambahkan data ke result
    public function add($data)
    {
        $this->get();

        $resultAdd = $this->results;

        array_push($resultAdd, $data);

        return $resultAdd;
    }

    // meremove data dari result params array
    public function remove($columns)
    {
        $this->get();

        $dataRemoves = $this->results;

        foreach ($columns as $column) {
            foreach ($dataRemoves as $key => $result) {
                unset($dataRemoves[$key]->$column);
            }
        }

        $this->results = $dataRemoves;

        return $this;
    }

    // menghapus data dari table database berdasarkan primary key
    public function delete($where = null)
    {
        if ($where) {

            $this->setQuery("DELETE from $this->table where $where")->setStatement();
        }

        $this->setQuery("DELETE from $this->table")->setStatement();

        return $this;
    }

    // untuk membuat link a
    public function makeLinkA($link, $text, $target = '_blank', $class = 'btn btn-sm btn-primary', $onclick = null)
    {
        if ($onclick) {

            return "<a href='$link' target='$target' class='$class' onclick=\"return confirm('$onclick');\">$text</a>";
        }

        return "<a href='$link' target='$target' class='$class'>$text</a>";
    }

    // untuk membuat badge
    public function makeLinkABadge($link, $text, $target = '_blank', $class = 'badge badge-sm badge-primary', $onclick = null)
    {
        if ($onclick) {

            return "<a href='$link' target='$target' class='$class' onclick=\"return confirm('$onclick');\">$text</a>";
        }

        return "<a href='$link' target='$target' class='$class'>$text</a>";
    }

    // untuk membuat link a
    public function makeLinkImg($link, $text, $target = '_blank', $linkImg, $width = null, $height = null)
    {
        return "<a href='$link' target='$target'><img src='$linkImg' alt='$text' width='$width' height='$height'></a>";
    }

    // untuk menghitung jumlah data result
    public function rowCount()
    {
        $this->get();

        return count($this->results);
    }

    // untuk mengecek apakah ada yang dicari atau tidak
    public function contains($column)
    {
        $this->get();

        return array_key_exists($column, $this->toArray()[0]);
    }

    // untuk membuat column tertentu
    public function except($dataExcept, &$data)
    {

        foreach ($dataExcept as $column) {
            unset($data[$column]);
        }
    }

    // untuk memilih column tertentu
    public function only($dataExcept, &$data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $dataExcept)) {

                unset($data[$key]);
            }
        }
    }

    // untuk pluck data
    public function pluck($columns)
    {

    }

    // untuk mengatur attribute ketika disimpan
    public function setAttributes()
    {

    }

    // untuk mengatur attribute ketika didapatkan
    public function getAttributes()
    {

    }

    // untuk mengubah ke rupiah

    // untuk mengubah ke uang indonesia
    public function toRupiah($value)
    {

        return "Rp" . number_format($value, 0, ',', '.');
    }

    // untuk mengubah ke uang indonesia
    public function toGmt7()
    {

    }

    // untuk join table
    public function join($table1, $table2, $on)
    {
        $this->setQuery("select * from $table1 join $table2 on $on")->setStatement();
        $this->results = $this->statement->fetchAll();

        return $this;
    }

    // untuk mengecek apakah ada clumn tertentu atau tidak
    public function hasColumn($column)
    {
        $this->get();
        $resultArrays = $this->toArray();

        foreach ($resultArrays as $key => $resultArray) {
            $resultColumn = array_keys($resultArray);

            return in_array($column, $resultColumn);
        }
    }

    // untuk mendapatkan semua data foreign
    public function getForeigns()
    {
        $this->setQuery("DESC $this->table")->setStatement();
        $dataColumns = [];

        foreach ($this->statement->fetchAll() as $key => $resultColumns) {
            if (preg_match('/id_/', $resultColumns->Field) && $key != 0) {

                $dataColumns[] = $resultColumns->Field;
            }
        }

        return $dataColumns;
    }

    // untuk memilih data yang tidak sama
    public function distinct($column, $where = null)
    {
        $this->setQuery("SELECT DISTINCT($column) FROM $this->table")->setStatement();

        if ($where) {

            $this->setQuery("SELECT DISTINCT($column) FROM $this->table WHERE $where")->setStatement();
        }

        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk memilih data yang terkecil
    public function min($column, $where = null)
    {
        $this->setQuery("SELECT MIN($column) FROM $this->table")->setStatement();

        if ($where) {

            $this->setQuery("SELECT MIN($column) FROM $this->table WHERE $where")->setStatement();
        }

        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk memilih data yang tertinggi
    public function max($column, $where = null)
    {
        $this->setQuery("SELECT MAX($column) FROM $this->table")->setStatement();

        if ($where) {

            $this->setQuery("SELECT MAX($column) FROM $this->table WHERE $where")->setStatement();
        }

        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk memilih data rata rata
    public function avg($column, $where = null)
    {
        $this->setQuery("SELECT AVG($column) FROM $this->table")->setStatement();

        if ($where) {

            $this->setQuery("SELECT AVG($column) FROM $this->table WHERE $where")->setStatement();
        }

        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk memilih data sum
    public function sum($column)
    {
        $this->get();

        $sum = 0;

        foreach ($this->results as $result) {
            $sum += $result->$column;
        }

        return $sum;
    }

    // untuk memilih data sum
    public function between($column, $values)
    {
        $this->setQuery("select * from $this->table where $column between {$values[0]} and {$values[1]}")->setStatement();
        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk memilih data sum
    public function groupBy($column)
    {
        $this->setQuery("select * from $this->table group by $column")->setStatement();
        $this->results = $this->statement->fetchAll();

        return $this->results;
    }

    // untuk
    public function whereNotIn($column, $values)
    {
        $results           = $this->get()->toArray();
        $resultWhereNotIns = [];

        foreach ($results as $position => $result) {

            foreach ($values as $value) {
                if ($result[$column] != $value) {

                    $resultWhereNotIns[] = $this->results[$position];
                }
            }
        }

        return count($resultWhereNotIns) ? $resultWhereNotIns : null;
    }

    public function encrypt($q)
    {
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $q, MCRYPT_MODE_CBC, md5(md5($this->key))));
        return ($qEncoded);
    }

    public function decrypt($q)
    {
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
        return ($qDecoded);
    }

    // untuk mengetahui jumlah colunmn
    public function getCountColumn()
    {
        $this->get();

        return count($this->toArray()[0]);
    }

    // untuk merandom
    public function random()
    {
        $this->get();

        $randomResults = $this->results;
        shuffle($randomResults);

        return $randomResults;
    }

    // untuk replace
    public function replace()
    {

    }

    // untuk replace
    public function truncate()
    {
        $this->setQuery("TRUNCATE $this->table")->setStatement();

        return $this;
    }

    // untuk transaction
    public function transaction()
    {

    }

    // untuk autorelation
    public function autoRelations()
    {

    }

    // untuk bikin url berdasarkan basepath
    public function url($path)
    {

        return $this->basePath . "/" . $path;
    }

    public function lower($value)
    {

        return strtolower($value);
    }

    public function uppper($value)
    {

        return strtoupper($value);
    }

    public function capitalize($value)
    {

        return ucwords($value);
    }

    public function snake($value)
    {

        return str_replace(" ", "_", $value);
    }

    // untuk mengkonversi ke url
    public function toUrl($data)
    {

        return http_build_query($data);
    }

    // untuk menambah nilai suatu column
    public function increment($column, $value, $where = null)
    {
        if ($where) {

            $this->setQuery("update $this->table set $column = $column + $value where $where")->setStatement();
        } else {

            $this->setQuery("update $this->table set $column = $column + $value")->setStatement();
        }

        return $this;
    }

    // untuk mengurangi nilai suatu column
    public function decrement($column, $value, $where = null)
    {
        if ($where) {

            $this->setQuery("update $this->table set $column = $column - $value where $where")->setStatement();
        } else {

            $this->setQuery("update $this->table set $column = $column - $value")->setStatement();
        }

        return $this;
    }

    public function getEnum($column)
    {
        $this->setQuery("SHOW COLUMNS FROM {$this->table} WHERE Field = '{$column}'")->setStatement();

        $this->results = $this->statement->fetchAll()[0];

        preg_match("/^enum\(\'(.*)\'\)$/", $this->results->Type, $matches);

        $this->results = explode("','", $matches[1]);

        return $this->results;
    }

    public function makeSelectEnum($column, $name, $selected = null, $class = '')
    {
        $options = array_map(function ($enumValue) use ($selected) {

            if ($selected == $enumValue) {

                return "<option value='$enumValue' selected>$enumValue</option>";
            }

            return "<option value='$enumValue'>$enumValue</option>";
        }, $this->getEnum($column));

        return count($options) ? "<select name='$name' class=''>" . implode("", $options) . "</select>" : null;
    }

    public function makeSelectTable($column, $selected = null, $where = null, $class = '')
    {
        $resultSelectTable = $this->all();

        if ($where) {
            $this->setQuery("select * from $this->table where $where")->setStatement();
            $resultSelectTable = $this->statement->fetchAll();
        }

        $options = [];
        foreach ($resultSelectTable as $tableResult) {
            if ($tableResult->{$this->primaryKey} == $selected) {

                $options[] = "<option value='{$tableResult->{$this->primaryKey}}' selected>{$tableResult->$column}</option>";
            } else {

                $options[] = "<option value='{$tableResult->{$this->primaryKey}}'>{$tableResult->$column}</option>";
            }
        }

        $name = preg_replace("/data_/", "id_", $this->getTable());

        return count($options) ? "<select name='$name' class=''>" . implode("", $options) . "</select>" : null;
    }

    public function makeSelectRelation($column, $name, $selected = null, $class = '')
    {
        
    }

    public function dd($data)
    {
        echo "<pre>";

        print_r($data);

        die();
    }

    // // merubah waktu supaya bisa dibaca berapa saat yg lalu
    // public function diffForHumans($datetime)
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     return Carbon::parse($datetime)->locale('id_ID')->diffForHumans();
    // }

    // public function diffForTimeIndo()
    // {

    //     return Carbon::now()->locale('id_ID')->format('d F Y');
    // }

    // // untuk memvalidasi inputan
    // public function validate($data)
    // {

    // }

    // public function back()
    // {
    //     return "<script>history.back() </script>";
    // }

    // public function chart()[{}
    // public function datatables()[{}]

    public function __get($property)
    {

        echo($property);
    }

    public function __call($method, $params)
    {
        $this->setTable($method);
        
        if(isset($params[1])) {

            return $this->{$this->table}->row($params[0], $params[1]);
        }

        if(count($params)) {

            return $this->{$this->table}->find($params[0]);
        }

        return $this->{$this->table}->all();
    }

}

$db = new DB('localhost', 'root', '', 'databases_2020_2021_putra_pengolahan_data_rehabilitas');

$db->data_admin->each(function($keys, $value) {
    echo $value;
});

// return $query->all()

// foreach($db->data_pemesanan() as $data_pemesanan) 
// {

//     print_r( $db->data_ruangan($data_pemesanan->id_ruangan));
// }