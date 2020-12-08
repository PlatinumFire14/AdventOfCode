<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));
$instructions = [];

foreach ($data as $instruction) {
    $segments = explode(" ", $instruction);
    $instructions[] = [
        'op'  => $segments[0],
        'val' => 0+$segments[1]
    ];
}

function run($instructions)
{
    $acc = 0;
    $used = [];
    $infinity = false;
    for ($i = 0; $i < count($instructions); $i++) {
        if (in_array($i, $used)) {
            $infinity = true;
            break;
        }
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
    return [$infinity, $acc];
}

$reference = $instructions;
$infinite = 0;
$finite = 0;

foreach ($instructions as $key => $instruction) {
    if (
        $instruction['op'] == 'jmp'
        || $instruction['op'] == ' nop'
    ) {
        $tmpInstructions = $instructions;
        $tmpInstructions[$key]['op'] = ($instruction['op'] == 'jmp') ? 'nop' : 'jmp';
        $result = run($tmpInstructions);
        if (!$result[0]) {
            $acc = $result[1];
            $finite++;
        } else {
            $infinite++;
        }
    }
}

echo "----------------------------------------".PHP_EOL;
echo "Infinite permutations: $infinite".PHP_EOL;
echo "Finite permutations: $finite".PHP_EOL;
echo "Acc: $acc".PHP_EOL;
echo "----------------------------------------".PHP_EOL;
