<?php 

include 'vendor/autoload.php';

use RamdanRiawan\DB;

$db = (new DB)
->setHost('localhost')
->setUser('root')
->setPassword('')
->setDb('databases_2020_2021_ali_elearning');

echo $db->data_admin->decrement('budi');