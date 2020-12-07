<?php

function total($find, $mult) {
    global $rules;
    global $totalBags;
    foreach($rules[$find] as $name => $amount) {
        $totalBags += $mult * $amount;
        total($name, $mult * $amount);
    }
}

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$rules = [];
$totalBags = 0;

foreach ($data as $item) {
    preg_match("/(.+?) bags contain/", $item, $match);
    $topBag = $match[1];
    if (strpos($item, 'no other') !== false) {
        $rules[$topBag] = [];
        continue;
    }
    $itemString = trim(substr($item, strlen($match[0])), ' .');
    preg_match_all("/(\d+) (.*?) bag/", $itemString, $matches);
    foreach ($matches[0] as $k => $match) {
        $rules[$topBag][$matches[2][$k]] = $matches[1][$k];
    }
}

total('shiny gold', 1);

var_dump($totalBags);
