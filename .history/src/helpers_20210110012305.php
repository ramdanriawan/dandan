<?php 

$nomor = 0;
function loopGenerator()
{
    global $nomor;
    
    yield $nomor++;
}

$loop = 1;
function loop()
{
    global $loop;

    return $loop++;
}