<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceType;
use Illuminate\Support\Facades\DB;
use Validator;

class ServiceTypesController extends Controller
{
    public static function store2($request,$id)
    {
        // define an array.

        $type=array();
        
        //  put all the values into array

        for($i=13;$i<19;$i++) {
            $a="type";
            $a =$a.$i;
            $type[$i-12]=($request->$a);
        }

        // get distinct vlues into array

        $type = array_unique($type);

        // store those values..
        
        foreach($type as $types){
            if($types != null){
                $type = new ServiceType();
                $type->service_id=$id;
                $type->type=$types;
                $type->save();
            }
        }
    }


    public static function update(Request $request)
    {
        $findType=ServiceType::where('service_id',$request->serviceID)->get();
        //dd($findlocations);
         foreach($findType as $type){
             DB::table('service_types')->where('service_id', $request->serviceID)->where('type',$type->type)->delete();
        }

        // define an array.

        $type=array();
        
        //  put all the values into array

        for($i=13;$i<19;$i++) {
            $a="type";
            $a =$a.$i;
            $type[$i-12]=($request->$a);
        }

        // get distinct vlues into array

        $type = array_unique($type);

        // store those values..
        
        foreach($type as $types){
            if($types != null){
                $type = new ServiceType();
                $type->service_id=$request->serviceID;
                $type->type=$types;
                $type->save();
            }
        }
    }

    public static function getTypes($id)
    {
        $types = ServiceType::where('service_id',$id)->get();
        return $types;
    }
}