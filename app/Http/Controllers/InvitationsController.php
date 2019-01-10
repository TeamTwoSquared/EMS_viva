<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use App\Client;
use Illuminate\Support\Facades\DB;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\client\ClientsController;
use App\Http\Controllers\InvitationsController;

class InvitationsController extends Controller
{

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
        //return $request;
        $this->validate($request, [
            'emails'=> 'required'
        ]);
        $emails=explode(" ", $request->emails);
        foreach($emails as $email)
        {
            $joiners=InvitationsController::checkJoiners($email,$request->event_id);
            $already_invites=InvitationsController::checkInvitation($email);
            if($joiners || $already_invites)
            {
                continue;
            }
            $invitation=new Invitation();
            $invitation->email = $email;
            $invitation->event_id =  $request->event_id;
            $invitation->save();
            Mail::to($email)->send(new SendInvitation($invitation));
        }
        return redirect("/client/myevents/$request->event_id");
    }

    //for check already invited
    public function checkInvitation($email)
    {
        $invites = Invitation::where('email',$email)->get();
        //dd(count($invites));
        if(count($invites)){
            return true;
        }
        else{
            return false;
        }
    }
    public function checkJoiners($email,$event_id)
    {
        //$clients=ClientEvent::where('event_id',$event_id);
        //$client=Client::where('email',$email)->get();
        $client=DB::table('customer_events')
                ->join('customers', 'customer_events.customer_id', '=', 'customers.customer_id')
                ->where('event_id', $event_id)
                ->where('email',$email)
                ->get();
        //dd($client);
        if(count($client)){
            return true;
        }
        else{
            return false;
        }
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