<?php
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
class DocumentController
{
    public $dir = __DIR__ .'/../../documents/';
    public $header = 0;
    public $filename = null;
    function __construct($dir=null,$header=null)
    {
        if($dir!== null)
        {
            $this->$dir = $dir;
        }
        if($header!== null)
        {
            $this->$header = $header;
        }
    }
    public function listFiles()
    {
    $files = preg_grep('~^Type_.*\.*$~', scandir($this->dir));
    return $files;
    }
    public function checkFileExtension($filename=null)
    {
        if($filename==null)
        {
            return 'filename invalid';
        }
        if(!file_exists($this->dir.$filename))
        {   
            return 'file doesnt exist';
        }
        foreach($this->listFiles() as $key =>$val)
        {
            $file = pathinfo($this->dir.$filename);
            switch($file['extension'])
            {
                case "xlsx":
                    return true;
                break;

                case "xls":
                    return true;
                break;

                case "csv":
                    return true;
                break;

                case "":
                 // Handle file extension for files ending in '.'
                    return false;
                case NULL: 
                // Handle no file extension
                    return false;
                break;
            }
        }
        
    }
    public function content()
    {
        $filename = $this->filename;

        $return_val = array();
        if($filename==null || empty($filename)){
            $return_val['error'] = 'invalid filename';
        }
        $explode_extension = explode('.', $filename);
		$extension = end($explode_extension);
        $file = $this->dir.$filename;
        if($file==null)
        {
            return 'error';
        }
        // print_r($file);
        switch($extension){
            case 'csv':
                $reader = new Csv();
                $return_val['filename'] = $filename;
            break;
            case 'xls':
                $reader = new Xls();
                $return_val['filename'] = $filename;
            break;
            case 'xlsx':
                $reader = new Xlsx();
                $return_val['filename'] = $filename;
            break;
        }
		
		$spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $return_val['data'] = $sheetData;
		return $return_val;
    }

    //validateRequiredField
    public function validateRequiredField()
    {
        //return fieldKey
        $required_field_key = array();
        foreach($this->content() as $key => $val)
        {
            if($key==0)
            {
                if($requiredField = substr($val,-1) == '*')
                {
                    $required_field_key['required_col'][] = $key; 
                }

            }
            return $required_field_key;
        }
    }
        
    //validateMissingValue
    public function validateHeader()
    {
        //return fieldKey
        //loop content
            //check header with asterisk and hashtag
                //return the column key in array for asterisk and hashtag
        $return_val = array(); 
        $content = $this->content();
        if(is_array($content['data'][$this->header])&&!empty($content['data'][$this->header]))
        {
            foreach ($content['data'][$this->header] as $key=>$val)
            {
                if(substr($val,-1)=='*')
                {
                    $return_val['required'][$key]['field'] = $val;
                }
                if(substr($val, 0,1)=='#')
                {
                    $return_val['no_space'][$key]['field'] = $val;

                }
            }
        }
        return $return_val;

    }
	public function getFieldName($field_name)
	{
		$field_name = str_replace('*','',$field_name);
		$field_name = str_replace('#','',$field_name);
		return $field_name;
	}
    public function validateValue()
    {
        $header = $this->validateHeader();
        // print_r($header);
        $return_val = array();
        // print_r($this->content()['data']);
        $result = '';

        $result_array = array();
        foreach($this->content()['data'] as $key => $val)
        {
          //foreach every column
          
          if($key>0)
          {
              $result = '';
              foreach($val as $col_key=>$col_val)
              {
                  if($col_val=='' || $col_val==null || empty($col_val))
                  {
                      if(array_key_exists($col_key,$header['required']))
                      {
                        // print_r($col_key);
                        $return_val['error']['required'][$key][$col_key] = 'missing value in row '.($key+1).' '.$this->getFieldName($header['required'][$col_key]['field']).'';
                        $result.= "missing value in row ".($key+1)." ".$this->getFieldName($header['required'][$col_key]['field']).",";
                        
                      }
                  }
                  if(strpos($col_val, ' ') !== false)
                  {
                    if(array_key_exists($col_key,$header['no_space']))
                    {
                        // print_r($col_key);
                        $return_val['error']['no_space'][$key][$col_key] = ' '.$this->getFieldName($header['no_space'][$col_key]['field']).' should have no space in '.($key+1).'';
                        $result.= $this->getFieldName($header['no_space'][$col_key]['field'])." should have no space in row ".($key+1).",";
                    }
                    
                  }
                // $result.=$result_nospace.$result_required;
                $result_array[($key+1)] = $result; 
              }
            }
            
        }
        // print($result);
        // var_dump($result_array);
        
        return $result_array;
    }
    
}