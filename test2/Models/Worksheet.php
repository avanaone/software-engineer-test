<?php

namespace Test2\Models;

use Test2\Models\Table;

class Worksheet{
    protected $activeSheet = null;
    protected $highestRow = null;
    protected $highestColumn = null;
    protected $errors = [];
    protected $headers = null;

    const RULES_COL_NUM = 5;
    const RULES_HEADERS_NAMES = [
        'Field_A*',
        '#Field_B',
        'Field_C',
        'Field_D*',
        'Field_E*',
    ];

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

    public function postLoading(){
        $this->verifyHeaders();
        $this->verifyRows();
        if($errors = $this->errors()){
            if(isset($errors["headersErrors"])){
                foreach ($errors["headersErrors"] as $key => $error) {
                    echo $error . "<br>";
                }
            }
            if(isset($errors["rowsErrors"])){
                Table::open();
                echo "<tr>";
                    echo "<td>Row</td> <td>Error</td>";
                echo "</tr>";
                foreach ($errors["rowsErrors"] as $key => $error) {
                    if($error) {
                        echo "<tr>";
                            echo "<td style='border:black 1.5px solid'>" . ($key+2) . "</td>";
                            echo "<td style='border:black 1.5px solid'>" . $error . "</td>";
                        echo "</tr>";
                    }
                }
                Table::close();
            }
            // die();
        }
    }

    public function loadSheet($filename){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        if($loaded = $reader->load($filename)){
            return $loaded->getActiveSheet();
        }
        return false;
    }

    public function getHeaders(){
        $headers = [];
        for ($col = 'A'; $col != $this->highestColumn ; $col++) {
            $headers []= $this->activeSheet->getCell($col . '1')->getValue();
        }
        return $headers;
    }

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

    public function verifyHeaders(){
        $errors = [];
        $headers = $this->headers = $this->getHeaders();
        if(($hcount = count($headers)) != static::RULES_COL_NUM){
            $errors []= 'Column count must be exactly 5! Got '.$hcount.' instead...';
        }else{
            foreach ($headers as $key => $header) {
                if($header !== static::RULES_HEADERS_NAMES[$key]){
                    $errors []= 'Header '.$key.' must be labelled as '.static::RULES_HEADERS_NAMES[$key];
                }
            }
        }
        $this->errors["headersErrors"] = $errors;
    }

    public function verifyRows(){
        $errors = [];
        $rows = $this->getRows();
        foreach ($rows as $key => $row) {
            $colError = '';
            foreach ($row as $key => $col) {
                if(strpos($this->headers[$key],'*') && trim($col) === ''){
                    $colError .= 'Missing value in '.$this->headers[$key].', ';
                }
                if(strpos($this->headers[$key],'#') !== false && trim($col) !== '' && strpos(trim($col),' ')!==false){
                    $colError .= $this->headers[$key].' should not contain any space, ';
                }
            }
            $errors []= rtrim($colError,', ');
        }
        $this->errors["rowsErrors"] = $errors;
    }

    public function errors(){
        return $this->errors;
    }
}
