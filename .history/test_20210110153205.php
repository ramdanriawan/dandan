<?php

error_reporting();

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
    ->setHost('localhost')
    ->setUser('root')
    ->setPassword('')
    ->setDb('dipo_crisvandoli.bikinaplikasi.dev')
    ->setConnection()
    ->setRelations([
        'buku'       => [
            'rak'               => [
                'column'        => 'rak_id',
                'table'         => 'rak',
                'refference'    => 'id',
                'relation_name' => 'belongstoone',
            ],
            'detail_peminjaman' => [
                'column'        => 'buku_id',
                'table'         => 'detail_peminjaman',
                'refference'    => 'id',
                'relation_name' => 'hastomany',
            ],
        ],
        'peminjaman' => [
            'pengembalian' => [
                'column'        => 'peminjaman_id',
                'table'         => 'pengembalian',
                'refference'    => 'id',
                'relation_name' => 'hastoone',
            ],
        ],
        'anggota' => [],
        'detail_peminjaman' => [],
        'kelas' => [],
        'pengembalian' => [],
        'session' => [],
        'user' => [],
        'rak' => [],
    ]);

foreach ($db->getTables() as $key => $item) {

    $$item = (clone $db)->$item;
}

foreach($buku() as $buku) {

    print_r($buku);
}