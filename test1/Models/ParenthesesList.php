<?php

namespace Test1;

use Models\Parentheses;

class ParenthesesList{
    protected $collection = [];

    public function __construct($string){
        return $this->processString($string);
    }

    public function open($startLocation){
        $this->collection []= new Parentheses($startLocation);
    }

    public function close($endLocation){
        foreach (array_reverse($this->collection) as $key => $parentheses) {
            if(!$parentheses->isClosed()){
                $parentheses->close($endLocation);
                break;
            }
        }
    }

    public function getCollection(){
        return $this->collection;
    }

    public function endLocationOf($startLocation){
        foreach ($this->collection as $key => $parentheses) {
            if($parentheses->startLocationIs($startLocation)){
                return $parentheses->getEndLocation();
            }
        }
    }

    public function processString($string){
        foreach (str_split($string) as $key => $char) {
            if($char == '('){
                $this->open($key);
            }else if($char == ')'){
                $this->close($key);
            }else{

            }
        }
        return $this;
    }
}
