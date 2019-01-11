<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceCustomerBooking;
use App\Client;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\svp\SVPsController;


class ServiceCustomerBookingsController extends Controller
{

    public static function getClients($booking_id)
    {
        //Use to return a client set when a booking Id is provided
        $serviceCustomerBookings = ServiceCustomerBooking::where('booking_id',$booking_id)->get();
        $client_all = Array();
        foreach($serviceCustomerBookings as $serviceCustomerBooking)
        {
            $client = Client::where('customer_id',$serviceCustomerBooking->customer_id)->get();
            $client = $client[0];
            $client_all = array_prepend($client_all,$client);
        }
        return $client_all;
        

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