<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));

$grid = [];
foreach ($data as $line) {
    $grid[] = str_split($line);
}

class Grid
{
    private $grid = [];
    private $referenceGrid = [];
    private $empty = 'L';
    private $occupied = '#';
    private $floor = '.';

    public function __construct($grid)
    {
        $this->grid = $grid;
        $this->referenceGrid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function sync()
    {
        $this->referenceGrid = $this->grid;
    }

    public function count()
    {
        $count = 0;
        foreach($this->grid as $yi => $yv) {
            foreach($yv as $xi => $xv) {
                if ($xv == '#') {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function draw()
    {
        echo PHP_EOL;
        foreach($this->grid as $yi => $yv) {
            foreach($yv as $xi => $xv) {
                echo "$xv ";
            }
            echo PHP_EOL;
        }
    }

    public function run()
    {
        foreach($this->referenceGrid as $yi => $yv) {
            foreach($yv as $xi => $xv) {
                $state = $xv;
                $occ = 0;
                $unOcc = 0;
                foreach(range(-1, 1) as $yOffset) {
                    foreach(range(-1, 1) as $xOffset) {
                        if (
                            !(
                                $yOffset == 0
                                && $xOffset == 0
                            )
                            && isset($this->referenceGrid[$yi+$yOffset][$xi+$xOffset])
                        ) {
                            $tempYOffset = $yOffset;
                            $tempXOffset = $xOffset;
                            while (
                                isset($this->referenceGrid[$yi+$tempYOffset][$xi+$tempXOffset])
                                && $this->referenceGrid[$yi+$tempYOffset][$xi+$tempXOffset] == $this->floor
                            ) {
                                $tempYOffset += ($tempYOffset <=> 0);
                                $tempXOffset += ($tempXOffset <=> 0);
                            }
                            if (isset($this->referenceGrid[$yi+$tempYOffset][$xi+$tempXOffset])) {
                                if ($this->referenceGrid[$yi+$tempYOffset][$xi+$tempXOffset] == $this->empty) {
                                    $unOcc++;
                                } else if ($this->referenceGrid[$yi+$tempYOffset][$xi+$tempXOffset] == $this->occupied) {
                                    $occ++;
                                }
                            }
                        }
                    }
                }
                if ($state == $this->empty && $occ == 0) {
                    $this->grid[$yi][$xi] = $this->occupied;
                } else if ($state == $this->occupied && $occ > 4) {
                    $this->grid[$yi][$xi] = $this->empty;
                }
            }
        }
    }

    public function compare($comparisonGrid)
    {
        $same = true;
        foreach ($this->grid as $yi => $yv) {
            foreach ($yv as $xi => $xv) {
                if (!isset($comparisonGrid[$yi][$xi]) || $comparisonGrid[$yi][$xi] !== $xv) {
                    $same = false;
                    break 2;
                }
            }
        }
        return $same;
    }
}

$grid = new Grid($grid);

$lastGrid = [];
while (!$grid->compare($lastGrid)) {
    $lastGrid = $grid->getGrid();
    $grid->run();
    $grid->sync();
}

echo $grid->count().' seated'.PHP_EOL;
