<?php 

$loop = 0;
function loop($start = 0, $step = 1)
{
    global $loop;

    return $loop += 1;
}