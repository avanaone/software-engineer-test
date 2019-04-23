<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use View;
use Session;
use Excel;
use File;

class AddyController extends Controller
{

 public function index()
 {
  return view('addy');
 }

 public function import(Request $request){
     //validate the xls file
  $this->validate($request, array(
   'file'      => 'required'
  ));

  $err=[];

  if($request->hasFile('file')){
   $extension = File::extension($request->file->getClientOriginalName());
   if ($extension == "xlsx" || $extension == "xls" ) {

    $path = $request->file->getRealPath();
    $data = Excel::load($path, function($reader) {
    })->get();
    if(!empty($data) && $data->count()){

      $a=0;

     foreach ($data as $key => $value) {
      
      $err[$a]['error']='';
      $err[$a]['val']=$a+2;

      if(isset($value->field_a)){
        if(!empty($value->field_a)){
            if(ctype_space($value->field_a)){
                $err[$a]['error'] = $err[$a]['error'].'FIELD_A should not contain any space, ';
            }
        }else{
            $err[$a]['error'] = $err[$a]['error'].'Missing value in Field_A, ';
        }
      }

      if(isset($value->field_b)){
        if(!empty($value->field_b)){
           if(ctype_space($value->field_b)){
                $err[$a]['error'] = $err[$a]['error'].'FIELD_B should not contain any space, ';
            }
        }else{
            $err[$a]['error'] = $err[$a]['error'].'Missing value in Field_B, ';
        }
      }

      if(isset($value->field_c)){
        if(!empty($value->field_c)){
          if(ctype_space($value->field_c)){
                $err[$a]['error'] = $err[$a]['error'].'FIELD_C should not contain any space, ';
            }
        }else{
            $err[$a]['error'] = $err[$a]['error'].'Missing value in Field_C, ';
        }
      }

      if(isset($value->field_d)){
        if(!empty($value->field_d)){
          if(ctype_space($value->field_d)){
                $err[$a]['error'] = $err[$a]['error'].'FIELD_D should not contain any space, ';
            }
        }else{
            $err[$a]['error'] = $err[$a]['error'].'Missing value in Field_D, ';
        }
      }

      if(isset($value->field_e)){
        if(!empty($value->field_e)){
          if(ctype_space($value->field_e)){
                $err[$a]['error'] = $err[$a]['error'].'FIELD_E should not contain any space, ';
            }
        }else{
            $err[$a]['error'] = $err[$a]['error'].'Missing value in Field_E, ';
        }
      }

      $a++;

     }


    }

    if(!empty($err)){
    
      Session::flash('error', '');
      return View::make("addy", compact('err'));

    }

    Session::flash('success', 'Success');
    return back();

   }else {
    Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/xlsx file..!!');
    return back();
   }
  }
 }

 

 
}

