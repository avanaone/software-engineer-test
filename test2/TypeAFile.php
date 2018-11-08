<?php

namespace Test2;

use Test2\Models\Worksheet;

class TypeAFile{
    public static function init(){
        return new static;
    }

    public function processTypeAFile(){
        return $this->getTypeAFile();
    }

    public function getTypeAFile(){
        $result = '';
        $worksheet = new Worksheet( __DIR__ . '/../Type_A.xlsx' );

        echo json_encode($worksheet->getRows());
        return $result;
    }
}
