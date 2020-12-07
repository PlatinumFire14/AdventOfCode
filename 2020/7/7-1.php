<?php

function find($find) {
    global $rules;
    global $paths;
    global $seen;
    foreach ($rules as $bag => $rule) {
        if (in_array($find, array_keys($rule))) {
            $seen[] = $bag;
            find($bag);
        }
    }
}

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$rules = [];
$paths = 0;
$seen = [];

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

find('shiny gold');

var_dump(count(array_unique($seen)));
