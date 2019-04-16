<?php

require '../vendor/autoload.php';

use App\Controllers\FileController;

$file = new FileController;
$files='files/Type_B.xlsx';
$content=$file->getContent($files);

if ($content!=false){
	if (count($content) > 0){	
		$colHead='';
		echo '
			<style>
				table {
				  border-collapse: collapse;
				}

				table, th, td {
				  border: 1px solid black;
				}
							</style>
			<table>
				<thead style="font-weight:bold;text-align:center">
					<td>Row</td>
					<td>Error</td>
				</thead>
		';
		foreach ($content as $row => $rowField) {
			if ($row==0){
				$colHead=$rowField;
				$requiredField=$file->getRequiredField($colHead);
				$noSpaceCol=$file->getNoSpaceCol($colHead);	
			}else{
				$file->checkValue($row,$rowField,$requiredField,$noSpaceCol,$colHead);					
			}
		}
		echo '</table>';		
	}
}else{
	echo "invalid file or not supported";
}


?>
