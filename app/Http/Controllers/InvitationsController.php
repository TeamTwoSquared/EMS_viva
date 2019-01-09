<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\client\ClientsController;

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
            if($email==ClientsController::getClient()->email)
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