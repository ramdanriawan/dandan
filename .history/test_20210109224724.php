<?php 

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
->setHost('localhost')
->setUser('root')
->setPassword('')
->setDb('dipo_crisvandoli.bikinaplikasi.dev')
->setConnection();

$user = $db->user();

echo( $user->getLoop());
echo( $user->getLoop());
echo( $user->getLoop());

$anggota = $db->anggota();

echo( $anggota->getLoop());
echo( $anggota->getLoop());
echo( $anggota->getLoop());
