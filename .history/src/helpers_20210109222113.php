<?php 

function loop($start = 1, $step = 1)
{
    yield $start += $step;
}