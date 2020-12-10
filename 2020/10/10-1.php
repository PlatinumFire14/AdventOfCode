<?php

$reference = explode("\n", file_get_contents(__DIR__.'/input.txt'));

asort($reference);

// Add the charger
$reference[] = end($reference)+3;

$differences = [];
$last = 0;

foreach ($reference as $key => $value) {
    $diff = $value-$last;
    if (!isset($differences[$diff])) {
        $differences[$diff] = 1;
    } else {
        $differences[$diff]++;
    }
    $last = $value;
}
echo '----------------'.PHP_EOL;
foreach ($differences as $difference => $amount) {
    echo "Differences of $difference: $amount".PHP_EOL;
}
echo 'Product of difference count: '.array_product($differences).PHP_EOL;
echo '----------------'.PHP_EOL;
