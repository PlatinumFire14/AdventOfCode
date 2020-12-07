<?php

$data = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));

$requirements = [
    'byr:',
    'iyr:',
    'eyr:',
    'hgt:',
    'hcl:',
    'ecl:',
    'pid:',
];
$totalReq = count($requirements);
$totalPass = 0;

foreach ($data as $item) {
    $pass = 0;
    foreach ($requirements as $req) {
        if (strpos($item, $req) !== false) {
            $pass++;
        }
    }
    if ($pass == $totalReq) {
        $totalPass++;
    }
}

var_dump($totalPass);
