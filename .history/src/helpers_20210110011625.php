<?php 

$loop = 1;
function loop()
{
    global $loop;
    
    return $loop++;
}