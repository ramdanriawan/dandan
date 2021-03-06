<?php

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
    ->setHost('localhost')
    ->setUser('root')
    ->setPassword('')
    ->setDb('dipo_crisvandoli.bikinaplikasi.dev')
    ->setConnection()
    ->setRelations([
        'buku' => [
            'rak' => [
                'column' => 'rak_id',
                'table' => 'rak',
                'refference' => 'id',
                'relation_name' => 'belongstoone'
            ],
            'detail_peminjaman' => [
                'column' => 'buku_id',
                'table' => 'detail_peminjaman',
                'refference' => 'id',
                'relation_name' => 'hastomany'
            ]
        ],
        'peminjaman' => [
            'pengembalian' => [
                'column' => 'id',
                'table' => 'pengembalian',
                'refference' peminjaman_id', 'hastoone']
        ]
    ]
);

foreach ($db->getTables() as $key => $item) {

    $$item = (clone $db)->$item;
}

foreach($buku() as $buku)
{
    print_r($rak->find($buku->rak_id)); die();
}