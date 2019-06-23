<?php

function findparenthesis($str, $idx){
	$ret_val=0;
	if ($str[$idx]=="("){
		$open_parenthesis=1;
		$close_parenthesis=0;
		for($i=0;$i<strlen($str);$i++){
			if ($str[$i]=="(" && $i>$idx){
				$open_parenthesis++;
			}elseif($str[$i]==")"){
				$close_parenthesis++;
			}
			
			if ($open_parenthesis==$close_parenthesis){
				$ret_val=$i;
				break;
			}
		}
	}
	echo $ret_val;
}	

findparenthesis("a (b c (d e (f) g) h) i (j k)",2);
?>
