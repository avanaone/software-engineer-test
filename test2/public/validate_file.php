<?php
require '../app/bootstrap.php';
use App\Controllers\DocumentController;
$file = null;
if(isset($_GET['file']) && !empty($_GET['file']))
{
    $file = $_GET['file'];
}

if($file==null)
{
    echo 'no file to validate';
    die();
}
$document = new DocumentController();
$document->filename = $file;
// print_r($document->content());
print_r($document->validateValue());

