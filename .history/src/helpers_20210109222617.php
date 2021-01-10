<?php 

function loopGenerator($start = 0, $step = 1)
{
    $loop = $start += $step;

    yield "$loop";
}

function loop()
{
    foreach (loopGenerator() as $key => $value)
    {
        return $value;
    }
}