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
        ''
    ]);

foreach ($db->getTables() as $key => $item) {

    $$item = (clone $db)->$item;
}

echo $anggota->setQuery("select * from anggota")->getQuery();
