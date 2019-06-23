<?php

function Test1Function($param1,$param2){
  $pecah_array = str_split($param1);
  $variable1 = 0;
  $variable2 = 0;
  $jml = count($pecah_array);
  $hasil = false;

  for($i = $variable2 ; $i < $jml ; $i++){
      if($pecah_array[$i]=='('){
            $variable1 = $variable1+1;
      }elseif($pecah_array[$i]==")"){
            $variable2 = $variable2+1;
      }

      if($variable1 == $variable2 && ($variable1>0 or $variable2>0)){
          // echo $jml; jika ada jadikan i 28
           $hasil = $i;
           $i =$jml;
      }
      
      
    }
    // echo "string";
  echo $hasil;
  // echo $jml;

}
Test1Function("a (b c (d e (f) g) h) i (j k)", 2);
?>