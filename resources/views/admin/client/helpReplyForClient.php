<?php

namespace App\Http\Controllers\support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use App\SupportRequest;
use App\SupportRequestAttachement;
use Illuminate\Support\Facades\DB;
use App\Client;
use App\helpModel;
use App\helpAndCommentModel;

class helpReplyForClient extends Controller
{
    public function index(){
        $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',1)->where('to_whome',2)->where('customer_id',session()->get('customer_id'))->get();
        $newHelpRequestComment = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',2)->where('customer_id',session()->get('customer_id'))->get();
         //dd($newHelpRequest);
        return view('admin.client.allNotificationsForClient')->with('notfication_title',$newHelpRequest)->with('help_comment',$newHelpRequestComment);
    }

    public function show($id){

        $readNotification=Notification::find($id);
        $readNotification->is_read=1;
        $readNotification->save();
        
        $notificationInfo=Notification::where('notification_id',$id)->get();

       // dd($notificationInfo[0]->support_request_id);
        
        $helpInfo=SupportRequest::where('support_request_id',$notificationInfo[0]->support_request_id)->get();
        ($helpInfo[0]->support_request_id);

        // get customer infomation

        $customerInfo=Client::where('customer_id',$helpInfo[0]->customer_id)->get();
    //    dd($customerInfo[0]->profilepic);

        $issueType=DB::table('support_request_type')->where('type_id',$helpInfo[0]->type_id)->get();
       // dd($issueType[0]->type);

       $issueImg=SupportRequestAttachement::where('support_request_id',$notificationInfo[0]->support_request_id)->get();
       // dd($issueImg);

       $comment=DB::table('help_and_comment')->where('support_request_id',$notificationInfo[0]->support_request_id)->get();
      //dd($comment);

        return view('admin.client.helpReplyForClient')->with('help_info',$helpInfo)->with('customer_info',$customerInfo)->with('issue_type',$issueType)->with('issue_image',$issueImg)->with("_comment",$comment);
    }

    public function store2(Request $request,$id){
      //  $getCommentInfo=DB::table('help_and_comment')->where('support_request_id',$id)->get();
        //dd($getCommentInfo);
        
      // dd((int)$id);
         // dd($request->comment);

         $getNotificationInfo=DB::table('notifications')->where('support_request_id',$id)->get();
   // dd($getNotificationInfo);
        //dd($getNotificationInfo[0]->notification_id);
   
           $commentInfo=new helpAndCommentModel();
           $commentInfo->comment=$request->comment;
           $commentInfo->support_request_id=((int)$id);
           $commentInfo->from_whome=2;
           $commentInfo->customer_id=session()->get('customer_id');
           $commentInfo->save();

           $getHelpInfo=DB::table('support_requests')->where('support_request_id',$id)->get();
           //dd($getHelpInfo);

        // support request notification type as 1
        // support request comment notification type as 2

        // get client information from client tabel

          //  dd(session()->get('customer_id'));
            $clientInfo=Client::where('customer_id',session()->get('customer_id'))->get();
            $clientName=$clientInfo[0]->name;
         //  $clientInfo=Client::find('customer_id',session()->get('customer_id'));
          // dd($clientInfo);

             $commentNotification=new Notification();
             $commentNotification->notification="You Have A Comment Of Support Request From Your Client $clientName";
             $commentNotification->support_request_id=$id;
             $commentNotification->type=2;
             $commentNotification->to_whome=1;
             $commentNotification->from_whome=2;
             $commentNotification->is_read=0;
             $commentNotification->customer_id=session()->get('customer_id');
             $commentNotification->save();

             
         
           return redirect('/client/notification/'.$getNotificationInfo[0]->notification_id);
    

    }
}
