<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$valid = 0;
foreach ($data as $i => $v) {
    preg_match("/(\d+)-(\d+)\s(\w):\s(.*)/", $v, $match);
    $counts = array_count_values(str_split($match[4]));
    if (
        isset($counts[$match[3]])
        && $counts[$match[3]] >= $match[1]
        && $counts[$match[3]] <= $match[2]
    ) {
        $valid++;
    }
}
echo $valid.PHP_EOL;
