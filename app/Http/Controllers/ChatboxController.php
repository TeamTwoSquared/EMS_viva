<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatBox;

class ChatboxController extends Controller
{
    public static function getMessages($event_id)
    {
        $messages = ChatBox::where('event_id',$event_id)->get();
        return $messages;
    }
    public function sendMessage(Request $request)
    {   
        //dd($request);
        //return $request;
        $this->validate($request, [
            'message'=> 'required|max:255'
        ]);

        $message=new ChatBox();
        $message->customer_id = $request->customer_id;
        $message->event_id =  $request->event_id;
        $message->message =  $request->message;
        $message->save();
        
        return redirect("/client/myevents/$request->event_id");
    }
}
