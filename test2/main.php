<?php
require_once __DIR__ .'/vendor/autoload.php';

use IzuddinTestPsr\Calculator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Validate{
	public function index($filename){
		// Load File
		$inputFileName = '../'.$filename;
		$err_msg=array();
		echo "Check in File : ".$filename."<br>";
		
		if (file_exists($inputFileName)){
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

			$worksheet = $spreadsheet->getActiveSheet();
			$col_required = $this->getTemplateColumnRequired($filename);
			$col_current = array();

			$rows_data=$worksheet->getRowIterator();
			foreach ($rows_data as $idx=>$row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE); 
				
				$col=1;
				foreach ($cellIterator as $cell) {
					$cellValue=$cell->getValue();
					// Check Column required
					if ($idx==1) $col_current[]=$cell->getValue();
					// Check Row Content
					if ($idx>1){
						$colName = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
						$clearColName = str_replace(array("*","#"),"",$colName);
						if (strpos($colName, '#') !== false) {
							if (strpos($cellValue, ' ') !== false){
								$err_msg[$idx][]=$clearColName." should not contain any space";
							}
						}elseif (strpos($colName, '*') !== false){
							if (empty($cellValue)){
								$err_msg[$idx][]="Missing value in ".$clearColName;
							}
						}
					}
					$col++;
				}
				// Column Name Checked
				if($col_current!==$col_required){
					$err_msg[1][]="Column should same with template";
					break;
				}
			}
		}else{
			$err_msg[0][]="File not Found!!";
		}
		
		return $this->getMessage($err_msg);
	}
	
	public function getTemplateColumnRequired($filename){
		$typeFileName=explode(".",$filename);
		$typeFileName=strtolower($typeFileName[0]);
		switch($typeFileName){
			case "type_a":
				return array("Field_A*","#Field_B","Field_C","Field_D*","Field_E*");
			break;
			case "type_b":
				return array("Field_A*","#Field_B");
			break;
		}
	}
	
	public function getMessage($err_msg){
		if (count($err_msg)>0){
			echo "<table cellpadding=1 cellspacing=0 border=1 width=100%>";
			echo "<thead><th width=50>Row</th><th>Error</th></thead>";
			echo "<tbody>";
			foreach($err_msg as $err_idx=>$err_item){
				echo "<tr>";
					echo "<td>".$err_idx."</td>";
					echo "<td>".implode(", ",$err_item)."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table><br>";
		}else{
			echo "Validate Successfully !! No error Found!";
		}
	}
}

$validate = new Validate;
$validate->index("Type_A.xlsx");
$validate->index("Type_B.xlsx");
