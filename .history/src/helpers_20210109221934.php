<?php 

function loop($start = 1, $step = 1)
{
    return yield $start += $step;
}