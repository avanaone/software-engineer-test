<?php
namespace Test1;

// The test
//
// The function takes 2 arguments, a string and an integer
// Assume that the integer correctly indicates the index position of an open parenthesis "(" inside the given string
// The function should return an integer, that indicates the index position of the correct corresponding close paren ")" inside the string taking into account nested parenthesized values
// You can write the function in PHP.
//
// Test Example Example
// If the function receives "a (b c (d e (f) g) h) i (j k)" and 2 as arguments.
//
// nameYourFunction("a (b c (d e (f) g) h) i (j k)", 2); // 2 here indicates the "(" right before "b"
//
// The function should return the index position of the ")" right after "h", in this case, the return value is 20.

use Test1\ParenthesesList;

class Test1{

    public static function init(){
        return new static;
    }

    public static function trueResponse($status=""){
        return [
            "success" => true,
            "status" => $status
        ];
    }

    public static function falseResponse($status=""){
        return [
            "success" => true,
            "status" => $status
        ];
    }

    public static function checkRestrictions($string,$parenThesispositIon){
        if($parenThesispositIon > strlen($string)){
            return static::falseResponse(
                "Warning : Location of start parenthesis should be less than the string length!"
            );
        }
        if($string[$parenThesispositIon] !== '('){
            return static::falseResponse(
                "Location\\ $parenThesispositIon is not a '('"
            );
        }
        return static::trueResponse();
    }

    public function find_endParenthesis($string,$parenThesispositIon){
        $result = static::checkRestrictions($string,$parenThesispositIon);
        if(!$result["success"]){
            return $result["status"];
        }
        $parenthesesList = new ParenthesesList($string);
        return $parenthesesList->endLocationOf($parenThesispositIon);
        // var_dump($parenthesesList->getCollection());
        // die('pass');
    }
}
