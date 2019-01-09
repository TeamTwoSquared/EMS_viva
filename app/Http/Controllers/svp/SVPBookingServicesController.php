<?php

namespace App\Http\Controllers\svp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SVPBookingService;
use App\Service;
use App\Http\Controllers\svp\SVPsController;

class SVPBookingServicesController  extends Controller
{

    public static function getServices($booking_id)
    {
        //Use to return a service set when a booking Id is provided for current service provider
        $SVPBookingServices = SVPBookingService::where('booking_id',$booking_id)->get();
        $service_all = Array();
        foreach($SVPBookingServices as $SVPBookingService)
        {
            $service = Service::where('service_id',$SVPBookingService->service_id)->get();
            $service = $service[0];
            $service_all = array_prepend($service_all,$service);
        }
        return $service_all;
        

    }
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}