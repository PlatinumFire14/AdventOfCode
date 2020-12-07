<?php 

$data = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));

$total = 0;

foreach ($data as &$item) {
    $item = array_unique(str_split(str_replace("\n", '', $item)));
    $total += count($item);
}

var_dump($total);
