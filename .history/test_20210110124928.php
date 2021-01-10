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
            'detail_peminjaman' => ['buku_id', 'detail_peminjaman', 'id', 'hastomany']
        ],
        'peminjaman' => [
            'pengembalian' => ['id', 'pengembalian', 'peminjaman_id', 'hastoone']
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