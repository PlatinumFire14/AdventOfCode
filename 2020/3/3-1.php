<?php

final class Slope {

    private $map = [];
    private $xPos = 0;
    private $yPos = 0;
    private $xSize = 0;
    private $ySize = 0;

    public function __construct(string $filePath = '')
    {
        if (!$filePath) {
            return;
        }
        $data = explode("\n" ,file_get_contents($filePath));
        foreach($data as $line) {
            $this->map[] = str_split($line);
        }
        $this->xSize = count($this->map[0])-1;
        $this->ySize = count($this->map)-1;
    }

    public function checkTree() : bool
    {
        return ($this->map[$this->yPos][$this->xPos] == '#');
    }

    public function moveRight($loops = 1) : void
    {
        foreach (range(1, $loops) as $i) {
            $this->xPos++;
            if( $this->xPos > $this->xSize ) {
                $this->xPos = 0;
            }
        }
    }

    public function moveDown($loops = 1) : void
    {
        foreach (range(1, $loops) as $i) {
            $this->yPos++;
        }
    }

    public function atEnd() : bool
    {
        return ($this->yPos == $this->ySize);
    }

    public function reset() : void
    {
        $this->xPos = 0;
        $this->yPos = 0;
    }

}

$slope = new Slope(__DIR__.'/input.txt');
$trees = [];
$treeIndex = 0;
$instructions = [
    ["r" => 3, "d" => 1],
];

foreach ($instructions as $job) {
    while (!$slope->atEnd()) {
        $slope->moveRight($job["r"]);
        $slope->moveDown($job["d"]);
        if ($slope->checktree()) {
            if (!isset($trees[$treeIndex])) {
                $trees[$treeIndex] = 0;
            }
            $trees[$treeIndex]++;
        }
    }
    $treeIndex++;
    $slope->reset();
}

echo array_product($trees).PHP_EOL;
