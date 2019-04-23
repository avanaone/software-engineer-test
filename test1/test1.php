<?php
function avanaTest($a,$b){

  $arr = str_split($a);
  $param1 = 0;
  $param2 = 0;
  $jml = count($arr);
  $result = false;
  
  for($x = $b ; $x < $jml ; $x++){
    
      if($arr[$x]=='('){
            $param1 = $param1+1;
      }elseif($arr[$x]==")"){
            $param2 = $param2+1;
      }
     
      if($param1 == $param2 && $param1>0){
           $result = $x;
           $x =$jml;
      }
      
      
    }
  
  echo $result;
  
}

avanaTest("a (b c (d e (f) g) h) i (j k)", 2);


?>