<?php
require_once __DIR__.'/vendor/autoload.php';

//pre html codes
\Test2\Models\Html::pre();


// Test1
$argument1 = "a (b c (d e (f) g) h) i (j k)";
$argument2 = 2;

echo "<hr>" . "<br>";
echo "****** TEST 1 *****" . "<br>";
echo "Input String : $argument1<br>";
echo "Input Integer :$argument2<br>";
echo "Result of Test1 : " . Test1\Test1::init()->find_endParenthesis($argument1,$argument2) . "<br>";
echo "<br><br><br><br>";




//Test2
echo "***** TEST 2 *****" . "<br>";
Test2\Test2::init();

//post html codes
\Test2\Models\Html::post();
