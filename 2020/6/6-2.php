<?php 

$data = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));

$total = 0;

foreach ($data as $item) {
    $groups = explode("\n", $item);
    if (count($groups) == 1) {
        $total += strlen($groups[0]);
        continue;
    }
    $possibilities = str_split($groups[0]);
    foreach ($groups as $entry) {
        foreach($possibilities as $k => $possibility) {
            if (!in_array($possibility, str_split($entry))) {
                unset($possibilities[$k]);
            }
        }
    }
    $total += count($possibilities);
}

var_dump($total);
