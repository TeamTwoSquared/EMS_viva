<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;
use App\Http\Controllers\MailController;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contactus');
    }

    //store feedback data in the DB
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'name'=>'required',
            'email'=> 'required',
            'phone'=> 'required',
            'message'=> 'required'
        ]);

        $contactus = new ContactUs();

        $contactus->name = $request->name;
        $contactus->email = $request->email;
        $contactus->tel = $request->phone;
        $contactus->messege = $request->message;
        $contactus->save();
        return redirect('/')->with('success','Feedback sent!');
    }
}    
