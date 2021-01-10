<?php

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
    ->setHost('localhost')
    ->setUser('root')
    ->setPassword('')
    ->setDb('dipo_crisvandoli.bikinaplikasi.dev')
    ->setConnection();

foreach ($db->getTables() as $key => $item) {

    $$item = (clone $db)->$item;
}

print_r($anggota->getColumns());