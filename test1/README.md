How To Use :


include 'class.strStrainer.php';

$str='a (b c (d e (f) g) h) i (j k)';

$result = $strainer->getPosPair($str,2);

echo $result;




//$result = $strainer->getPosPair($str,2); //20

//$result = $strainer->getPosPair($str,7); //17

//$result = $strainer->getPosPair($str,12); //14

//$result = $strainer->getPosPair($str,1); //mismatch

