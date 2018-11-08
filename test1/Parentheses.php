<?php

namespace Test1;

class Parentheses{
    protected $startLocation = null;
    protected $endLocation = null;

    public function __construct($startLocation){
        $this->startLocation = $startLocation;
    }

    public function open($startLocation){
        $this->startLocation = $startLocation;
    }

    public function close($endLocation){
        $this->endLocation = $endLocation;
    }

    public function isOpened(){
        return $this->startLocation!==null;
    }

    public function isClosed(){
        return $this->endLocation!==null;
    }

    public function startLocationIs($startLocation){
        return $this->startLocation === $startLocation;
    }

    public function endLocationIs($endLocation){
        return $this->endLocation === $endLocation;
    }

    public function getStartLocation(){
        return $this->startLocation;
    }

    public function getEndLocation(){
        return $this->endLocation;
    }
}
