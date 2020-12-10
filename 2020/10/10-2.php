
<?php

$reference = explode("\n", file_get_contents(__DIR__.'/input.txt'));

array_walk($reference, function (&$x){
    $x = (int) $x;
});

sort($reference);
$reference[] = end($reference)+3;

$last = 0;
$singlets = 0;
$possibilities = 1;

foreach ($reference as $key => $value) {
    $diff = $value-$last;
    switch($diff) {
        case 1:
            $singlets++;
            break;
        case 3:
            $possibilities *= ((($singlets ** 2) - $singlets + 2) / 2);
            $singlets = 0;
            break;
    }
    $last = $value;
}

if ($singlets)  {
    $possibilities *= ((($singlets ** 2) - $singlets + 2) / 2);
}

var_dump($possibilities);
