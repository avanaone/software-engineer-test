<?php

function pairIndex($inputString,$bracketIndex,$toMatch)
{
    if($bracketIndex == null ||  $inputString == null || empty($inputString))
    {
        return 'invalid parameter';
    }
    if (!is_int($bracketIndex))
    {
        return 'index must be an integer';
    }
    
    if (substr($inputString,$bracketIndex,1)==$toMatch){
        $indicator = 1;
        $inputLen = strlen($inputString);
        for ($i = $bracketIndex + 1; $i < $inputLen; $i++) {
            switch (substr($inputString,$i,1)){
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