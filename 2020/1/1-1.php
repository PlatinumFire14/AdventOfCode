<?php

$data = explode("\n" ,file_get_contents(__DIR__.'/input.txt'));
$target = 2020;

foreach ($data as $i1 => $v1) {
    if ($v1 >= $target) {
        continue;
    }
    foreach ($data as $i2 => $v2) {
        if ($i1 == $i2) {
            continue;
        }
        $sum = $v1 + $v2;
        echo "Testing $v1 + $v2 = $sum - ";
        if ($sum == $target) {
            echo "SUCCESS".PHP_EOL;
            echo "Answer: ".$v1 * $v2.PHP_EOL;
            exit;
        }
        echo "FAILURE".PHP_EOL;
    }
}
