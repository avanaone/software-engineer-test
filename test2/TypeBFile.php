<?php

namespace Test2;

use Test2\Models\WorksheetB;

class TypeBFile{
    public static function init(){
        return new static;
    }

    public function processTypeBFile(){
        return $this->getTypeBFile();
    }

    public function getTypeBFile(){
        $worksheet = new WorksheetB( __DIR__ . '/../Type_B.xlsx' );
    }
}
