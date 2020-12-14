<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));

class Location
{
    private $ew = 0;
    private $ns = 0;
    private $dir = 1;
    private $dirs = [ 0 => 'N', 1 => 'E', 2 => 'S', 3 => 'W' ];

    function N($travel)
    {
        $this->ns += $travel;
    }

    function S($travel)
    {
        $this->ns -= $travel;
    }

    function E($travel)
    {
        $this->ew += $travel;
    }

    function W($travel)
    {
        $this->ew -= $travel;
    }

    function F($travel)
    {
        $this->{$this->dirs[$this->dir]}($travel);
    }
    
    function R($deg)
    {
        $steps = $deg/90;
        foreach(range(1, $steps) as $step) {
            $this->dir += 1;
            if ($this->dir == 4) {
                $this->dir = 0;
            }
        }
    }

    function L($deg)
    {
        $steps = $deg/90;
        foreach(range(1, $steps) as $step) {
            $this->dir -= 1;
            if ($this->dir == -1) {
                $this->dir = 3;
            }
        }
    }

    function manhattan()
    {
        return abs($this->ns)+abs($this->ew);
    }

}

$journey = new Location();

foreach ($data as $instruction) {
    $process = substr($instruction, 0, 1);
    $amount = substr($instruction, 1);
    $journey->{$process}($amount);
}

echo $journey->manhattan().PHP_EOL;
