<?php
require '../app/bootstrap.php';
use App\Lib\Bcheck;
use App\Controllers\DocumentController;

$base_url = "http://localhost:7070";
$inputString="a (b c (d e (f) g) h) i (j k)";
$bracketIndex = 2;
$toMatch = '(';
$bCheck = new Bcheck($inputString,$bracketIndex,$toMatch);
echo $inputString.'<br>';
echo 'index of matching bracket is: '.$bCheck->pairIndex();



