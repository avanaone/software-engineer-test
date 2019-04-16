<?
include 'class.strStrainer.php';
$strainer = new strStrainer();
$str='a (b c (d e (f) g) h) i (j k)';

$result = $strainer->getPosPair($str,2);
echo $result;

?>