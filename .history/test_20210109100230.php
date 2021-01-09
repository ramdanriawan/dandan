<?php 

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = new DB;
$db->setHost('localhost')
->setUser('root')
->setPassword('')
->setDb('databases_2020_2021_ali_elearning');

$db->data_admin();