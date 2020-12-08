<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$instructions = [];
$acc = 0;
$used = [];
$infinity = false;

foreach ($data as $instruction) {
    $segments = explode(" ", $instruction);
    $instructions[] = [
        'op'  => $segments[0],
        'val' => 0+$segments[1]
    ];
}

function run($instructions)
{
    global $used;
    global $acc;
    global $infinity;
    for ($i = 0; $i < count($instructions); $i++) {
        if (in_array($i, $used)) {
            $infinity = true;
            break;
        }
        #echo $instructions[$i]['op']." : ".$instructions[$i]['val'].PHP_EOL;
        switch ($instructions[$i]['op']) {
            case 'nop':
                break;
            case 'acc':
                $acc += $instructions[$i]['val'];
                break;
            case 'jmp':
                $i += $instructions[$i]['val']-1;
                break;
        }
        $used[] = $i;
    }
}

run($instructions);

echo "----------------------------------------".PHP_EOL;
echo "Infinite loop: ".($infinity ? 'Yes' : 'No').PHP_EOL;
echo "Instructions parsed: ".count($used).PHP_EOL;
echo "acc: ".$acc.PHP_EOL;
echo "----------------------------------------".PHP_EOL;
