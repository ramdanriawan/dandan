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
            'rak' => ['rak_id', 'rak', 'id', 'belongstoone'],
            'detail_peminjaman' => ['buku_id', 'detail_peminjaman', 'id', 'hastomany']
        ],
        'peminjaman' => [
            'pengembalian' => ['pengembalian_id', 'pengembalian', 'id', 'belongstoone']
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