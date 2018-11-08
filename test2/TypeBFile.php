<?php

namespace Test2;

class TypeBFile{
    public static function init(){
        return new static;
    }

    public function processTypeBFile(){
        return $this->getTypeBFile();
    }

    public function getTypeBFile(){
        $type_B_filename = __DIR__ . '/../Type_B.xlsx';
        return \PhpOffice\PhpSpreadsheet\IOFactory::load($type_B_filename)->getActiveSheet()->getCell('A1')->getValue();
    }
}
