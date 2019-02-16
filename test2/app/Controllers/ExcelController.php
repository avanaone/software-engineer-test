<?php

namespace App\Controllers;

class ExcelController
{
    public function __construct($filename){
        $this->objPHPExcel = $this->createReader($filename);
        $this->sheet = $this->objPHPExcel->getSheet(0); 
        $this->sheetData = $this->objPHPExcel->getActiveSheet()->toArray(null,true,true,true); 
        $this->highestRow = $this->sheet->getHighestRow(); 
        $this->validateFile();
    }

    public function createReader($filename){
        $inputFileName = 'app/Files/'.$filename;
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        return $objReader->load($inputFileName);
    }

    public function validateFile()            
    {
        for($i=2;$i<=$this->highestRow;$i++){
            $validation[$i] = '';
            foreach ($this->sheetData[$i] as $key => $value) {
                if (strpos($this->sheetData[1][$key], '*') !== false) {
                    if($value==null){
                        if($validation[$i]==""){
                            $validation[$i] .= 'Missing Value in '.str_replace("*","",$this->sheetData[1][$key]);
                        }
                        else{
                            $validation[$i] .= ', Missing Value in '.str_replace("*","",$this->sheetData[1][$key]);
                        }
                    }
                        
                }
                else if(strpos($this->sheetData[1][$key], '#') !== false) {
                    if(preg_match('/\s/',$value)){
                        if($validation[$i]==""){
                            $validation[$i] .= str_replace("#","",$this->sheetData[1][$key]).' should not contain any space';
                        }
                        else{
                            $validation[$i] .= ', '.str_replace("#","",$this->sheetData[1][$key]).' should not contain any space';
                        }
                            
                    }
                }    
            }
        }

        $this->validation = $validation;
    }

    public function echo()
    {
        echo '<table>
            <tr>
                <th>Row</th>
                <th>Errors</th>
            </tr>';

            foreach ($this->validation as $key => $value) {
                if($value!=""){
                     echo '
                    <tr>
                        <td>'.$key.'</td>
                        <td>'. $value.'</td>
                    </tr>';
                }
            }
        echo '
        </table><br><br>';
    }
}
