<?php

namespace Test2;

use Test2\Models\WorksheetA;

class TypeAFile{
    public static function init(){
        return new static;
    }

    public function processTypeAFile(){
        return $this->getTypeAFile();
    }

    public function getTypeAFile(){
        $worksheet = new WorksheetA( __DIR__ . '/../Type_A.xlsx' );

        // echo json_encode($worksheet->getRows());
    }
}
