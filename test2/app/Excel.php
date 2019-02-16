<?php
namespace App;

use  App\Controllers\ExcelController;

class Excel{

	public static function validateFiles(){
        echo "File Type_A";
        $excel = new ExcelController('Type_A.xlsx');
	    $excel->echo();

        echo "File Type_B";
        $excel = new ExcelController('Type_B.xlsx');
	    $excel->echo();
    }
}