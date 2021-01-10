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
            'rak_id' => ['rak', 'rak_id', 'belongstoone'],
            'rak' => ['rak', 'buku_id', 'onetoone'],
            'raks' => ['rak', 'buku_id', 'onetomany']
        ]
    ]
);

foreach ($db->getTables() as $key => $item) {

    $$item = (clone $db)->$item;
}

foreach($buku() as $buku)
{
    print_r($buku->rak_id->id);
}