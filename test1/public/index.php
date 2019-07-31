<?php
require '../app/bootstrap.php';
require './checker.php';


$base_url = "http://localhost:7070";
$inputString="a (b c (d e (f) g) h) i (j k)";
$bracketIndex = 2;
$toMatch = '(';
$pairedIndex = pairIndex($inputString,$bracketIndex,$toMatch);
echo 'index of matching bracket is: '.$pairedIndex;



