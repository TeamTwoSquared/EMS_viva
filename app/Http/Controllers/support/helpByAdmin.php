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
use App\SVP;
use Validator;

class helpByAdmin extends Controller
{
    public function index(){
        $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',1)->where('to_whome',1)->get();
        $newHelpRequestComment = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',1)->get();
        return view('admin.client.supportByAdmin')->with('notfication_title',$newHelpRequest)->with('support_comments',$newHelpRequestComment);
    
    }

    public function show($id){

        $readNotification=Notification::find($id);
        $readNotification->is_read=1;
        $readNotification->save();
        
        $notificationInfo=Notification::where('notification_id',$id)->get();

       // dd($notificationInfo[0]->support_request_id);
        
        $helpInfo=SupportRequest::where('support_request_id',$notificationInfo[0]->support_request_id)->get();
       // dd($helpInfo[0]->support_request_id);

        // get customer infomation
        if($helpInfo[0]->from_whome== 2){
            $userInfo=Client::where('customer_id',$helpInfo[0]->customer_id)->get();
            // dd($customerInfo[0]->profilepic);
        }
       // dd($customerInfo);
        if($helpInfo[0]->from_whome==3){
            $userInfo=SVP::where('service_provider_id',$helpInfo[0]->service_provider_id)->get();
           //dd($svpInfo);
        }
        //dd($svpInfo[0]);
        $issueType=DB::table('support_request_type')->where('type_id',$helpInfo[0]->type_id)->get();
       // dd($issueType[0]->type);

       $issueImg=SupportRequestAttachement::where('support_request_id',$notificationInfo[0]->support_request_id)->get();
       // dd($issueImg);

       $comment=DB::table('help_and_comment')->where('support_request_id',$notificationInfo[0]->support_request_id)->get();
      //dd($comment);

        return view('admin.client.helpRequest')->with('help_info',$helpInfo)->with('user_info',$userInfo)->with('issue_type',$issueType)->with('issue_image',$issueImg)->with("_comment",$comment);
    }

    public function store2(Request $request,$id){
        //$getCommentInfo=DB::table('help_and_comment')->where('support_request_id',$id)->get();
        //dd($getCommentInfo[0]);
        
        // dd((int)$id);
        // dd($request->comment);
        $validator = Validator::make($request->all(), [
            'comment' => 'required|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/notification/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        
         $getNotificationInfo=DB::table('notifications')->where('support_request_id',$id)->get();
       // dd($getNotificationInfo[0]->customer_id);
   
           $commentInfo=new helpAndCommentModel();
           $commentInfo->comment=$request->comment;
           $commentInfo->support_request_id=((int)$id);
           $commentInfo->from_whome=1;
           $commentInfo->save();

           // notification comment by admin

           $getFromWhome=DB::table('support_requests')->where('support_request_id',$id)->get();
           //dd($getFromWhome[0]);
            if($getFromWhome[0]->from_whome == 2){
               // notification for client by admin..
              // dd($getFromWhome);
                $commentNotification=new Notification();
                $commentNotification->notification="EMS Support Center";
                $commentNotification->support_request_id=$id;
                $commentNotification->type=2;
                $commentNotification->to_whome=2;
                $commentNotification->from_whome=1;
                $commentNotification->is_read=0;
                $commentNotification->customer_id=($getFromWhome[0]->customer_id);
                $commentNotification->save();
           }

           if($getFromWhome[0]->from_whome == 3){
            // notification for service provider by admin..
                $commentNotification=new Notification();
                $commentNotification->notification="EMS Support Center";
                $commentNotification->support_request_id=$id;
                $commentNotification->type=2;
                $commentNotification->to_whome=3;
                $commentNotification->from_whome=1;
                $commentNotification->is_read=0;
                $commentNotification->service_provider_id=($getFromWhome[0]->service_provider_id);
                $commentNotification->save();
            }

           return redirect('/admin/notification/'.$getNotificationInfo[0]->notification_id);
    

    }

    public function isRead($id){
        $readNotification=Notification::find($id);
        $readNotification->is_read=1;
        $readNotification->save();
       
    }
}
