<?php

$reference = explode("\n", file_get_contents(__DIR__.'/input.txt'));

$preamble = 25;
$offset = 0;

$run = true;

while ($run) {
    $tempArray = $reference;
    $calcBlock = array_slice($tempArray, $offset, $preamble);
    $target = $reference[$preamble+$offset];
    $valid = false;
    foreach ($calcBlock as $xi => $xv) {
        foreach ($calcBlock as $yi => $yv) {
            if (
                $xi != $yi
                && ($xv + $yv) == $target
            ) {
                echo "$xv + $yv = $target".PHP_EOL;
                $valid = true;
                break 2;
            }
        }
    }
    if (!$valid) {
        echo "Cannot find target $target".PHP_EOL;
        $run = false;
    }
    $offset++;
}
