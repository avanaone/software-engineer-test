<?php
require '../app/bootstrap.php';
use App\Controllers\DocumentController;
$config = new App\Config\Settings();

$base_url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];

$document = new DocumentController();
// echo '<pre>';
// print_r($document->listFiles());
$file_arr = $document->listFiles();
// print_r($document->checkFileExtension('Type_A.xlsx'));
$validFile = array();
foreach($file_arr as $key=>$val)
{
    if($document->checkFileExtension($val))
    {
        $validFile['validFile'][]['filename'] = $val;
        
    }

}
foreach($validFile['validFile'] as $key=>$val)
{
    echo "<a href='".$base_url."/validate_file.php?file=".$val['filename']."'>".$val['filename']."</a></br>";
}
// print_r($validFile);
// echo __DIR__;

