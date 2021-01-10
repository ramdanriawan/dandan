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

echo( $user->loop());
echo( $user->loop());
echo( $user->loop());

$anggota = $db->anggota();

echo( $anggota->loop(2));
echo( $anggota->loop(2));
echo( $anggota->loop(2));
