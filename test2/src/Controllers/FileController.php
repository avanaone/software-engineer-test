<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class FileController
{

    public function getContent($files)
    {
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$arr_file = explode('.', $files);
		$extension = end($arr_file);
	 
		if('csv' == $extension) {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}elseif('xlsx' == $extension) {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}elseif('xls' == $extension) {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		}else{
			return false;
		}
	 
		$spreadsheet = $reader->load($files);
		 
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		return $sheetData;
    }
	
	public function getRequiredField($arrStr)
	{
		$requiredField='';
		foreach ($arrStr as $col => $val)
		{
			if(substr($val, -1)=='*')
			{
				$requiredField.=$col.',';
			}
		}
		
		return substr($requiredField,0,-1);
	}
	
	public function getNoSpaceCol($arrStr)
	{
		$noSpaceCol='';
		foreach ($arrStr as $col => $val)
		{
			if(substr($val, 0,1)=='#')
			{
				$noSpaceCol.=$col.',';
			}
		}
		
		return substr($noSpaceCol,0,-1);
	}
	
	public function getFieldName($arrStr,$col)
	{
		$fieldName=$arrStr[$col];
		$fieldName = str_replace('*','',$fieldName);
		$fieldName = str_replace('#','',$fieldName);
		return $fieldName;
	}
	
	public function checkValue($row,$arrStr,$requiredField,$noSpace,$colHead)
	{
		$result='';
		$error = '';
		foreach ($arrStr as $col => $val)
		{
			$x=strval($col);
			if(strpos($requiredField, $x) !== false && trim($val)=='' )
			{
				$error = 'yes';
				$result.="Missing value in ".$this->getFieldName($colHead,$col).",";
			}elseif(strpos($noSpace, $x) !== false && strpos($val, ' ') !== false){
				$error = 'yes';
				$result.=$this->getFieldName($colHead,$col)." should not contain any space,";
			}		
			
		}
		
		if ($error=='yes') {
			$row++;
			$result = substr($result,0,-1);
			echo '<tr><td>'.$row.'</td><td>'.$result.'</td></tr>';
		}
	}

}








