<?php

$reference = explode("\n", file_get_contents(__DIR__.'/input.txt'));

$find = 138879426;
$stop = count($reference);
$correctSet = [];

foreach ($reference as $key => $number) {
    $acc = $number;
    $set = [];
    for ( $i = ($key+1); $i < $stop; $i++  ) {
        $set[] = $reference[$i];;
        $sum = array_sum($set);
        if ($sum == $find) {
            $correctSet = $set;
            break 2;
        } elseif ($sum > $find) {
            continue 2;
        }
    }
}

sort($correctSet);

echo $correctSet[0].' + '.end($correctSet).' = '.($correctSet[0] + end($correctSet)).PHP_EOL;
