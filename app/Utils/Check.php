<?php
namespace App\Utils;
use Validator;
use Illuminate\Http\Request;
class Check {
    public static function valid($request, $valid)
    {
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            $error_message="";
            $i=0;
            foreach($validator->errors()->all() as $error){
                $error_message = $error_message." ".$error;
                $i++;
            }
            $data = array(
                'status' => false,
                'message' => $error_message
            );
            return $data ;      
        }else{
            return $data=null;
        }
    }
    public static function valid_html($request, $valid)
    {
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            $error_message="";
            $i=0;
            foreach($validator->errors()->all() as $error){
                $error_message = $error_message." <br> ".$error;
                $i++;
            }
            $data = array(
                'status' => false,
                'message' => $error_message
            );
            return $data ;      
        }else{
            return $data=null;
        }
    }
    public static function validation($request, $valid)
    {
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            return $validator;   
        }else{
            return $data=null;
        }
    }
}