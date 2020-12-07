<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$valid = 0;
foreach ($data as $i => $v) {
    preg_match("/(\d+)-(\d+)\s(\w):\s(.*)/", $v, $match);
    if (
        $match[4][$match[1]-1] == $match[3]
        ^ $match[4][$match[2]-1] == $match[3]
    ) {
        $valid++;
    }
}
echo $valid;
