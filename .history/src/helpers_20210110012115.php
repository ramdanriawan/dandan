<?php 

function loopGenerator()
{
    $nomor = 0;
    
    yield $nomor;
}

$loop = 1;
function loop()
{
    global $loop;

    return $loop++;
}