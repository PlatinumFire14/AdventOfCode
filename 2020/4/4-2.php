<?php

$data = explode("\n\n", file_get_contents(__DIR__.'/input.txt'));

$requirements = [
    "/(byr):([^\s]+)/",
    "/(iyr):([^\s]+)/",
    "/(eyr):([^\s]+)/",
    "/(hgt):(\d+)(\w+)/",
    "/(hcl):(\#[^\s]{6})/",
    "/(ecl):([^\s]+)/",
    "/(pid):([^\s]+)/",
];
$reqCount = count($requirements);
$ecl = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
$totalPass = 0;

foreach ($data as $i => $item) {
    $pass = 0;
    foreach ($requirements as $req) {
        preg_match($req, $item, $match);
        if (!$match) {
            continue;
        }
        switch($match[1]) {
            case 'byr':
                if ($match[2] >= 1920 && $match[2] <= 2002) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'iyr':
                if ($match[2] >= 2010 && $match[2] <= 2020) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'eyr':
                if ($match[2] >= 2020 && $match[2] <= 2030) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'ecl':
                if (in_array($match[2], $ecl)) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'pid': 
                if (is_numeric($match[2]) && strlen($match[2]) == 9) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'hcl':
                if (preg_match("/#[0-9a-f{6}]/", $match[2])) {
                    $pass++;
                    continue 2;
                }
                break;
            case 'hgt':
                if ($match[3] == 'cm') {
                    if ($match[2] >= 150 && $match[2] <= 193) {
                        $pass++;
                        continue 2;
                    }
                } elseif ($match[3] == 'in') {
                    if ($match[2] >= 59 && $match[2] <= 76) {
                        $pass++;
                        continue 2;
                    }
                }
                break;
        }
    }
    if ($pass == $reqCount) {
        $totalPass++;
    }
}

var_dump($totalPass);
