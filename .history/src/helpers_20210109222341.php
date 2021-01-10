<?php 

function loopGenerator($start = 1, $step = 1)
{
    yield $start += $step;
}

function loop()
{
    return loopGenerator();
}