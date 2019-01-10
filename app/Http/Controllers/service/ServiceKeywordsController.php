<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceKeyword;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Service;
use Validator;


class ServiceKeywordsController extends Controller
{
   
    public static function store2($request, $id){

        // define an array.

        $key=array();
        
        //  put all the values into array

        for($i=1;$i<7;$i++) {
            $a="keyword";
            $a =$a.$i;
            $key[$i]=($request->$a);
        }

        // get distinct vlues into array

        $key = array_unique($key);

        // store those values..
        foreach($key as $keywords){
            if($keywords != null){
                $keyword = new ServiceKeyword();
                $keyword->service_id=$id;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }
    }

    public static function update(Request $request)
    {

        $findKeywords=ServiceKeyword::where('service_id',$request->serviceID)->get();
         foreach($findKeywords as $keyword){
             DB::table('service_keywords')->where('service_id', $request->serviceID)->where('keyword',$keyword->keyword)->delete();
        }


        // define an array.

        $key=array();
        
        //  put all the values into array

        for($i=7;$i<13;$i++) {
            $a="keyword";
            $a =$a.$i;
            $key[$i-6]=($request->$a);
        }

        // get distinct vlues into array

        $key = array_unique($key);

        // store those values..
        foreach($key as $keywords){
            if($keywords != null){
                $keyword = new ServiceKeyword();
                $keyword->service_id=$request->serviceID;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }  
    }
}