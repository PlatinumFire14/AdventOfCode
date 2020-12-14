<?php

$data = explode("\n", file_get_contents(__DIR__.'/input.txt'));

class Location
{
    public $ew = 0;
    public $ns = 0;
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

    function F($waypoint, $amount)
    {
        $this->ew += ($waypoint->ew * $amount);
        $this->ns += ($waypoint->ns * $amount);
    }
    
    function R($deg)
    {
        if (!$deg) {
            return;
        }
        foreach(range(1, $deg/90) as $step) {
            $tempNS = $this->ns;
            $tempEW = $this->ew;
            if ($tempNS > 0) {
                $this->ew = $tempNS;
            } else {
                $this->ew = $tempNS;
            }
            if($tempEW > 0) {
                $this->ns = (0 - $tempEW);
            } else {
                $this->ns = abs($tempEW);
            }
        }
    }

    function L($deg)
    {
        $this->R(360-$deg);
    }

    function manhattan()
    {
        return abs($this->ns)+abs($this->ew);
    }

}

$waypoint = new Location();
$waypoint->E(10);
$waypoint->N(1);
$ship = new Location();

foreach ($data as $instruction) {
    $process = substr($instruction, 0, 1);
    $amount = substr($instruction, 1);
    if ($process == 'F') {
        $ship->F($waypoint, $amount);
    } else {
        $waypoint->{$process}($amount);
    }
}

echo $ship->manhattan().PHP_EOL;
