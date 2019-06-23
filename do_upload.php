<?php
include 'PHPExcel/PHPExcel/IOFactory.php';
$file = $_FILES["attachment"]["tmp_name"];
$ext  = pathinfo($_FILES["attachment"]['name'], PATHINFO_EXTENSION);
$size =$_FILES['attachment']['size'];
 $validasi=['xls','xlsx'];
if($file){
	if(in_array($ext, $validasi)){
		if ($size < 104857600) {
	PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
	$objPHPExcel	= PHPExcel_IOFactory::load($file);
    $titles = $objPHPExcel->getActiveSheet()->rangeToArray('A1:' . $objPHPExcel->getActiveSheet()->getHighestdataColumn() ."1");
    $endColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(count($titles[0])-1);
    $highestRow 	= $objPHPExcel->getActiveSheet()->getHighestRow();
    $colVal = array();
    $colA = array();
    $colB = array();
    $colC = array();
    $colD = array();
    $colE = array();
    $rownya_empty=array();
    $rownya=array();

    $colValX=[];

    $rownya_empty1=array();
    $rownya1=array();
    $no=0;
     for($i=2; $i<=$highestRow; $i++) {
    $rownya_empty[$no]['pesan']='';
    $rownya_empty[$no]['row_ke']=$i;

     	$colVal["Field_A"]=$objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
     	$colVal["Field_B"]=$objPHPExcel->getActiveSheet()->getCell("B".$i)->getFormattedValue();
     	$colVal["Field_C"]=$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
     	$colVal["Field_D"]=$objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
     	$colVal["Field_E"]=$objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();


     	if(!empty($colVal["Field_A"])){
     		if (preg_match('/\s/',$colVal["Field_A"])) {
	       		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan']." Field_A should not contain any space,";	
	    	}
		}else{
     		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan'].' Missing value in Field_A,';
		}

		if(!empty($colVal["Field_B"])){
     		if (preg_match('/\s/',$colVal["Field_B"])) {
	       		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan']." Field_B should not contain any space,";	
	    	}
		}else{
     		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan'].' Missing value in Field_B,';
		}

		if($titles[0][2]!=''){
		// if(!empty($colVal["Field_C"])){
  //    		if (preg_match('/\s/',$colVal["Field_C"])) {
	 //       		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan']." Field_C should not contain any space,";	
	 //    	}
		// }else{
  //    		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan'].' Missing value in Field_C,';
		// }

		if(!empty($colVal["Field_D"])){
     		if (preg_match('/\s/',$colVal["Field_D"])) {
	       		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan']." Field_D should not contain any space,";	
	    	}
		}else{
     		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan'].' Missing value in Field_D,';
		}

		if(!empty($colVal["Field_E"])){
     		if (preg_match('/\s/',$colVal["Field_E"])) {
	       		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan']." Field_E should not contain any space,";	
	    	}
		}else{
     		$rownya_empty[$no]['pesan']=$rownya_empty[$no]['pesan'].' Missing value in Field_E';
		}
		}
     	// array_push($colA, $colVal["Field_A"]);
     	// array_push($colB, $colVal["Field_B"]);
     	// array_push($colC, $colVal["Field_C"]);
     	// array_push($colD, $colVal["Field_D"]);
     	// array_push($colE, $colVal["Field_E"]);
     	$no++;
     }
// print_r($colValX);
     //print_r(count($colC));

    
 //     foreach ($colA as $key => $value) {
	//     if (empty($value)) {
	//        	$d=" Missing value in Field_A,";	
	//     }else if (preg_match('/\s/',$colA[$key])){
	//     	$d = " Field_A should not contain any space,";
	//     }
	//  }



	//  foreach ($colB as $key => $value) {
 //     	if (empty($value)) {
	//         $d="Field B Row ";
	//     }else if (preg_match('/\s/',$colB[$key])){
	//     	$d="Field B Row ";
	//     }
	//  }
	//  // print_r($rownya);
	//  // print_r($rownya_empty);

	// if((count($titles[0])-1)>=3){
	//  foreach ($colC as $key => $value) {
 //     	if (empty($value)) {
	//        echo "Field C Row ".($key+$no)." empty";
	//     }else if (preg_match('/\s/',$colC[$key])){
	//     	echo "Field C Row ".($key+$no)." containing space character";
	//     }
	//  }

	//  foreach ($colD as $key => $value) {
 //     	if (empty($value)) {
	//        echo "Field D Row ".($key+$no)." empty";
	//     }else if (preg_match('/\s/',$colD[$key])){
	//     	echo "Field D Row ".($key+$no)." containing space character";
	//     }
	//  }

	//  foreach ($colE as $key => $value) {
 //     	if (empty($value)) {
	//        echo "Field E Row ".($key+$no)." empty";
	//     }else if (preg_match('/\s/',$colE[$key])){
	//     	echo "Field E Row ".($key+$no)." containing space character";
	//     }
	//  }
	// }
	// $data=array_merge($rownya_empty,$rownya);
	// foreach ($data as $key =>$value) {
	// 	$hasil=explode("#", $value);
	// 	// print_r($hasil);
	// }
	

	// print_r($rownya_empty);
	// print_r($data);
 		}else{
 			$pesan_validasi="max file 10 mb";
 		}
 	}else{
 		$pesan_validasi="type file xls or xlxs";
 	}
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasil</title>
</head>
<body>
	<?php if(!empty($rownya_empty)){ ?>
	<table border="1" cellpadding="1" cellspacing="0">
		<thead bgcolor="#3785ee">
			<th>Row</th>
			<th>Error</th>
		</thead>
		<tbody bgcolor="a9c9f4">
			<?php foreach ($rownya_empty as $key) {
				if($key['pesan']!=''){
			 ?>
			<tr>
				<td><?php echo $key['row_ke'] ?></td>
				<td><?php echo substr($key['pesan'], 0,-1); ?></td>
			</tr>
			<?php }
			 } 
			?>
		</tbody>
	</table>
	<?php }else{
		echo $pesan_validasi;
	} ?>
</body>
</html>


