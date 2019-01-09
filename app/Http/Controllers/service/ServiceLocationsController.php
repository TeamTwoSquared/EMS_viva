<?php

namespace App\Http\Controllers\service;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceLocation;
use Illuminate\Support\Facades\DB;

class ServiceLocationsController extends Controller
{

    public static function store2($request,$id)
    {
        
        for($i=7;$i<13;$i++) {
            $a="location";
            $a =$a.$i;
            if(($request->$a) != null){   
                $loc = new ServiceLocation();
                $a="location";
                $a =$a.$i;
                $loc->service_id = $id;
                $loc->location= $request->$a;
                $loc->save();
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

        for($i=1;$i<7;$i++) {
            $a="location";
            $a =$a.$i;
        
            if(($request->$a) != null){
                        $loc = new ServiceLocation();
                        $a="location";
                        $a =$a.$i;
                        $loc->service_id = $request->serviceID;
                        $loc->location = $request->$a;
                        $loc->save();
            }
        }
    }

    public static function getLocations($id)
    {
        $locations = ServiceLocation::where('service_id',$id)->get();
        return $locations;
    }
}