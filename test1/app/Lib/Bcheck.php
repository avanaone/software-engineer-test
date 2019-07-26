<?php
namespace App\Lib;
class Bcheck{
    public $inputString = null;
    public $bracketIndex = null;
    public $toMatch = "(";
    function __construct($inputString=null,$bracketIndex=null,$toMatch=null)
    {
        $this->inputString = $inputString;
        $this->bracketIndex = $bracketIndex;
        $this->toMatch = $toMatch;
    }
    function pairIndex()
    {
        if($this->bracketIndex == null ||  $this->inputString == null || empty($this->inputString))
        {
            return 'invalid parameter';
        }
        if (!is_int($this->bracketIndex))
        {
            return 'index must be an integer';
        }
        
        if (substr($this->inputString,$this->bracketIndex,1)==$this->toMatch){
            $indicator = 1;
            $inputLen = strlen($this->inputString);
            for ($i = $this->bracketIndex + 1; $i < $inputLen; $i++) {
                switch (substr($this->inputString,$i,1)){
                    case '(':
                        $indicator++;
                        break;
                    case ')':
                        $indicator--;
                        if ($indicator == 0) {
                            return $i;
                        }
                        break;
                    
                }
            }
            return 'no match found'; 
        }else{
            return 'nothing to match';
        }
		
    }
}

