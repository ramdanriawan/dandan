<?php 

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
->setHost('localhost')
->setUser('root')
->setPassword('')
->setDb('dipo_crisvandoli.bikinaplikasi.dev');

print_r($db->getDb());