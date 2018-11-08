<?php
require_once __DIR__.'/vendor/autoload.php';

//pre html codes
\Test2\Models\Html::pre();


// Test1
$test1_input_1 = "a (b c (d e (f) g) h) i (j k)";
$test1_input_2 = 2;

echo "<--------- TEST 1 ---------->" . "<br>";
echo "Input 1 of Test1: $test1_input_1<br>";
echo "Input 2 of Test1: $test1_input_2<br>";
echo "Result of Test1: " . Test1\Test1::init()->endParenthesisFinder($test1_input_1,$test1_input_2) . "<br>";
echo "<br><br><br><br>";




//Test2
echo "<--------- TEST 2 ---------->" . "<br>";
Test2\Test2::init();

//post html codes
\Test2\Models\Html::post();
