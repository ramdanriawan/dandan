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
            'detail_peminjaman' => ['rak_id', 'rak', 'id', 'belongstoone'],
            'rak' => ['rak_id', 'rak', 'id', 'belongstoone']
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