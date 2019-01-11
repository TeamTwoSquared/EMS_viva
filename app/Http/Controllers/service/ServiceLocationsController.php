<?php

namespace App\Http\Controllers\service;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceLocation;
use Illuminate\Support\Facades\DB;
use Validator;

class ServiceLocationsController extends Controller
{

    public static function store2($request,$id)
    {
       
        // define an array..
        $loc=array();

        // put all the locations into array..

        for($i=7;$i<13;$i++) {
            $a="location";
            $a =$a.$i;
            $loc[$i-6]=($request->$a);
        }

        // get destinct values of array..
        $loc = array_unique($loc);

        // store those values in the database

        foreach($loc as $locations){
            if($locations != null){

                $location = new ServiceLocation();
                $location->service_id=$id;
                $location->location=$locations;
                $location->save();
            }
        }
    }


    public static function update(Request $request)
    {
        $findlocations=ServiceLocation::where('service_id',$request->serviceID)->get();
        //dd($findlocations);
         foreach($findlocations as $location){
             DB::table('service_locations')->where('service_id', $request->serviceID)->where('location',$location->location)->delete();
        }

        // define an array..
        $loc=array();

        // put all the locations into array..

        for($i=1;$i<7;$i++) {
            $a="location";
            $a =$a.$i;
            $loc[$i]=($request->$a);
        }

        // get destinct values of array..
        $loc = array_unique($loc);

        // store those values in the database

        foreach($loc as $locations){
            if($locations != null){

                $location = new ServiceLocation();
                $location->service_id=$request->serviceID;
                $location->location=$locations;
                $location->save();
            }
        }
    }

    public static function getLocations($id)
    {
        $locations = ServiceLocation::where('service_id',$id)->get();
        return $locations;
    }
}