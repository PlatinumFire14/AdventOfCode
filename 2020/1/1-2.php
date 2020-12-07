<?php

$data = explode("\n" ,file_get_contents(__DIR__.'/input.txt'));
$target = 2020;

foreach ($data as $i1 => $v1) {
    if ($v1 >= $target) {
        continue;
    }
    foreach ($data as $i2 => $v2) {
        if ($i1 == $i2 || $v1 + $v2 >= $target) {
            continue;
        }
        foreach ($data as $i3 => $v3) {
            if ($i1 == $i3 || $i2 == $i3) {
                continue;
            }
            $sum = $v1 + $v2 + $v3;
            if ($sum == $target) {
                echo "Answer: ".$v1 * $v2 * $v3.PHP_EOL;
                exit;
            }
        }
    }
}
