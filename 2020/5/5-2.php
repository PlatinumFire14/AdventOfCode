<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$list = [];
foreach($data as $item) {
    $list[] = str_split($item);
}

$seatIds = [];

foreach ($list as $set) {
    $currentRowStart = 0;
    $currentRowEnd = 127;
    $currentColumnStart = 0;
    $currentColumnEnd = 7;
    foreach ($set as $char) {
        switch ($char) {
            case 'F':
                $currentRowEnd = floor(($currentRowStart+$currentRowEnd)/2);
                break;
            case 'B':
                $currentRowStart = ceil(($currentRowStart+$currentRowEnd)/2);
                break;
            case 'L':
                $currentColumnEnd = floor(($currentColumnStart+$currentColumnEnd)/2);
                break;
            case 'R':
                $currentColumnStart = ceil(($currentColumnStart+$currentColumnEnd)/2);
                break;
        }
    }
    $seatIds[] = (8 * $currentRowEnd) + $currentColumnEnd;
}

sort($seatIds);

$missingSeat = 0;

foreach ($seatIds as $seatIndex => $seatId) {
    if ($seatIds[$seatIndex+1] != $seatId+1) {
        $missingSeat = $seatId+1;
        break;
    }
}

var_dump($missingSeat);
