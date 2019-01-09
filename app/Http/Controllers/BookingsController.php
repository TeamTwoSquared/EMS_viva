<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\SVPBookingService;
use App\Mail\SVPBookingSendClientInvitation;
use App\Mail\ClientBookingSendSVPInvitation;
use App\Mail\DeleteBooking;
use App\Mail\ApproveBooking;
use App\Http\Controllers\svp\SVPsController;
use Illuminate\Support\Facades\Mail;
use App\EventTemplateTask;
use App\ServiceCustomerBooking;
use App\Task;
use App\Event;
use App\Http\Controllers\service\ServiceCustomerBookingsController;
use App\SVP;
use App\Service;

class BookingsController extends Controller
{
    public function make_reservation($event_id,$task_id,$svp_id,$service_id)
    {
        $event = Event::find($event_id);
		$svp= SVP::find($svp_id);

        $booking = new Booking();
        $booking->date = $event->date;
        $booking->stime = $event->stime;
        $booking->etime = $event->etime;
        $booking->status = 0;
        $booking->service_provider_id = $svp_id;
        $booking->service_id = $service_id;
        $booking->save();
		
		$data['booking_id']=$booking->booking_id;
        $data['service'] = $service_id;
        Mail::to($svp->email)->send(new ClientBookingSendSVPInvitation($data));


        $prv_ett = EventTemplateTask::where('event_id',$event_id)->where('task_id',$task_id);
        $prev_ett_details = $prv_ett->get()[0];
        if($prev_ett_details->booking_id) Booking::find($prev_ett_details->booking_id)->delete();
        $prv_ett->delete();

        $ett = new EventTemplateTask();
        $ett->event_id = $event_id;
        $ett->task_id = $task_id;
        $ett->service_id = $service_id;
        $ett->booking_id = $booking->booking_id;
        $ett->save();

        $scb = new ServiceCustomerBooking();
        $scb->service_id = $service_id;
        $scb->customer_id = session()->get('customer_id');
        $scb->booking_id = $booking->booking_id;
        $scb->save();

        return 1;

    }

    public function index()
    {
        $svp=SVPsController::getSVP();
        $bookings = BookingsController::getBookingForSVP($svp->service_provider_id);
        //dd($bookings);
        return view('svp.bookingInfo')->with('bookings',$bookings);
    }

   
    public function create()
    {
        return view('svp.createBooking');
    }

    
    public function store(Request $request)
    {
        $svp=SVPsController::getSVP();


        //Validating submited details
        $this->validate($request, [
            'date'=> 'required',
            'start_time'=> 'required',
            'end_time'=> 'required',
            'services'=> 'required',
        ]);

        $booking = new Booking();
        $booking->date =  $request->date;
        $booking->stime =  $request->start_time;
        $booking->etime =  $request->end_time;
        $booking->status = 1;
        $booking->service_provider_id =  $svp->service_provider_id;
        $booking->save();

        //Saving catergory_template data
        foreach($request->services as $service)
        {
            $SVPBookingServices = new SVPBookingService();
            $SVPBookingServices->service_provider_id = $svp->service_provider_id;
            $SVPBookingServices->booking_id = $booking->booking_id;
            $SVPBookingServices->service_id = $service;
            $SVPBookingServices->save();
        }
        
        if($request->client != null)
        {
            $data['booking_id']=$booking->booking_id;
            $data['services']=$request->services;
            Mail::to($request->client)->send(new SVPBookingSendClientInvitation($data));
        }

        //On success go and add tasks
        return redirect('/svp/booking/');
    }

    
    public function block($booking_id)
    {
        $booking = Booking::where('booking_id',$booking_id)->get();
        $booking = $booking[0];
        if ($booking->status==0)
        {
            $booking->status=1;
            $data['booking_id']=$booking_id;
            $clients=ServiceCustomerBookingsController::getClients($booking_id);
            foreach($clients as $client)
            {
                Mail::to($client->email)->send(new ApproveBooking($data));
            }
        }
        $booking->save();
        return redirect('/svp/booking');
    }

    
    public function destroy($booking_id)
    {
        $clients=ServiceCustomerBookingsController::getClients($booking_id);
        $data['booking_id']=$booking_id;
        foreach($clients as $client)
        {
            Mail::to($client->email)->send(new DeleteBooking($data));
        }
        Booking::where('booking_id',$booking_id)->delete();       
        return redirect('/svp/booking');
    }

    //geting bookings for booking id
    public static function getBooking($booking_id)
    {
        $bookings = Booking::where('booking_id',$booking_id)->get();
        return $bookings[0];
    }
    //geting bookings for service provider id
    public static function getBookingForSVP($service_provider_id)
    {
        $bookings = Booking::where('service_provider_id',$service_provider_id)->get();
        return $bookings;
    }
    public static function getBookingFordate($date)
    {
        $bookings = Booking::where('date',$date)->get();
        return $bookings;
    }
}