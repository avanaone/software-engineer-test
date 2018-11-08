<?php

namespace Test2\Models;

use Test2\Models\Table;

class Worksheet{
    //local variables
    protected $activeSheet = null;
    protected $highestRow = null;
    protected $highestColumn = null;
    protected $errors = [];
    protected $headers = null;

    //worksheet rules
    public $RULES_COL_NUM = null;
    public $RULES_HEADERS_NAMES = null;

    //load sheet and get the sheet info
    public function __construct($filename){
        if($loaded = $this->loadSheet($filename)){
            $this->activeSheet = $loaded;
            $this->highestRow = $this->activeSheet->getHighestRow();
            $this->highestColumn = $this->activeSheet->getHighestColumn();
            $this->highestColumn++;
            $this->postLoading();
            return $this;
        }
        return false;
    }

    //runs after the sheet is loaded
    //verifies the headers and the rows
    public function postLoading(){
        $this->verifyHeaders();
        $this->verifyRows();
    }

    //sheet loader function
    public function loadSheet($filename){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        if($loaded = $reader->load($filename)){
            return $loaded->getActiveSheet();
        }
        return false;
    }

    //retrieves headers from sheet
    public function getHeaders(){
        $headers = [];
        for ($col = 'A'; $col != $this->highestColumn ; $col++) {
            $headers []= $this->activeSheet->getCell($col . '1')->getValue();
        }
        return $headers;
    }

    //retrieves rows from sheet
    public function getRows(){
        $rows = [];
        for ($row = 2; $row <= $this->highestRow ; $row++) {
            $cols = [];
            for ($col = 'A'; $col != $this->highestColumn ; $col++) {
                $cols []= $this->activeSheet->getCell($col . $row)->getValue();
            }
            $rows []= $cols;
        }
        return $rows;
    }

    //verifies headers for rules and populates error if there is
    public function verifyHeaders(){
        $errors = [];
        $headers = $this->headers = $this->getHeaders();
        if(
            $this->RULES_COL_NUM
            &&
            ($hcount = count($headers)) != $this->RULES_COL_NUM
        ){
            $errors []= 'Column count must be exactly '.$this->RULES_COL_NUM.'! Got '.$hcount.' instead...';
        }

        if($this->RULES_HEADERS_NAMES){
            foreach ($headers as $key => $header) {
                if($header !== $this->RULES_HEADERS_NAMES[$key]){
                    $errors []= 'Header '.$key.' must be labelled as '.$this->RULES_HEADERS_NAMES[$key];
                }
            }
        }
        $this->errors["headersErrors"] = $errors;
    }

    //verifies rows for rules and populates error if there is
    public function verifyRows(){
        $errors = [];
        $rows = $this->getRows();
        foreach ($rows as $key => $row) {
            $colError = '';
            foreach ($row as $key => $col) {
                if(strpos($this->headers[$key],'*') && trim($col) === ''){
                    $colError .= 'Missing value in '.trim($this->headers[$key],'*').', ';
                }
                if(strpos($this->headers[$key],'#') !== false && trim($col) !== '' && strpos(trim($col),' ')!==false){
                    $colError .= trim($this->headers[$key],'#').' should not contain any space, ';
                }
            }
            $errors []= rtrim($colError,', ');
        }
        $this->errors["rowsErrors"] = $errors;
    }

    //returns populated errors
    public function errors(){
        return $this->errors;
    }

    //prints error if there is
    public function printErrors(){
        if($errors = $this->errors()){
            if(isset($errors["headersErrors"])){
                foreach ($errors["headersErrors"] as $key => $error) {
                    echo $error . "<br>";
                }
            }
            if(isset($errors["rowsErrors"])){
                Table::open();
                Table::row(
                    Table::getColumn( "Row" ).
                    Table::getColumn( "Error" )
                );
                foreach ($errors["rowsErrors"] as $key => $error) {
                    if($error) {
                        Table::row(
                            Table::getColumn( $key+2 ).
                            Table::getColumn( $error )
                        );
                    }
                }
                Table::close();
            }
            // die();
        }
    }
}
