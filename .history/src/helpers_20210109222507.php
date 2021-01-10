<?php 

function loopGenerator($start = 0, $step = 1)
{
    yield $start += $step;
}

function loop()
{
    foreach (loopGenerator() as $key => $value)
    {
        return $value;
    }
}