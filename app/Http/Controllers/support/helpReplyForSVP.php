<?php

namespace App\Http\Controllers\support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SupportRequest;
use App\SupportRequestAttachement;
use App\helpModel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Notification;
use App\SVP;
use App\helpAndCommentModel;
use Validator;

class helpReplyForSVP extends Controller
{
    public function index(){
        return view('admin.client.supportConditionsForSVP');
    
    }

    public function create(){
        return view('admin.client.supportForSVP');
       // return view('svp.test');
    }

    
    public function store(Request $request){
        
       //   dd(session()->get('svp_id'));
       $validator = Validator::make($request->all(), [
        'description' => 'required|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/getSupport')
                        ->withErrors($validator)
                        ->withInput();
        }    
        $help=new SupportRequest();
        $help->request=$request->description;
        $help->service_provider_id=session()->get('svp_id');
        $typeid = DB::table('support_request_type')->where('type', $request->issue_type)->value('type_id');
        $help->type_id=$typeid;
        $help->from_whome=3;
        $help->save();
        
        if($request->issue_image != null)
        {  
            for($i=0; $i<count($request->issue_image);$i++)
            {
                $image = $request->issue_image[$i];
                // Get filename with the extension
                $filenameWithExt = $image->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $image->getClientOriginalExtension();
                
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload 
                $image_up = $image;
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(460, 310);
                $image_resize->save(public_path('storage/images/services/' .$fileNameToStore));
                
                //Adding URL to template_images table
                
                $supportImg=new SupportRequestAttachement();
                $supportImg->support_request_id=$help->support_request_id;
                $supportImg->attachement_url=$fileNameToStore;
                $supportImg->type_id=$typeid;
        
                $supportImg->save();
            }
        }

        // sending notification..
        
        $notification=new Notification();
        $svpName = DB::table('service_providers')->where('service_provider_id',session()->get('svp_id'))->value('name');
       // dd(session()->get('service_provider_id'));
        $notification->notification=("You Have A Support Request From Your Service Provider ".$svpName);
        $notification->support_request_id=$help->support_request_id;
        $notification->type=1;
        $notification->to_whome=1;
        $notification->from_whome=3;
        $notification->service_provider_id=session()->get('svp_id');
        $notification->save();
        return redirect('/svp/dash')->with('success','Successfully submited the help request !' );

    }


    public function allNotification(){
        $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',1)->where('to_whome',3)->where('service_provider_id',session()->get('svp_id'))->get();
        $newHelpRequestComment = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',3)->where('service_provider_id',session()->get('svp_id'))->get();
       //  dd($newHelpRequestComment);
        return view('admin.client.allNotificationForSVP')->with('notfication_title',$newHelpRequest)->with('help_comment',$newHelpRequestComment);
    }

    public function notifications(){
        $newHelpRequest = DB::table('notifications')->where('type',1)->where('to_whome',3)->where('service_provider_id',session()->get('svp_id'))->get();
        $newHelpRequestComment = DB::table('notifications')->where('type',2)->where('to_whome',3)->where('service_provider_id',session()->get('svp_id'))->get();
       //  dd($newHelpRequestComment);
        return view('admin.client.allNotificationForSVP')->with('notfication_title',$newHelpRequest)->with('help_comment',$newHelpRequestComment);
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

        $svpInfo=SVP::where('service_provider_id',$helpInfo[0]->service_provider_id)->get();
    //    dd($customerInfo[0]->profilepic);

        $issueType=DB::table('support_request_type')->where('type_id',$helpInfo[0]->type_id)->get();
       // dd($issueType[0]->type);

       $issueImg=SupportRequestAttachement::where('support_request_id',$notificationInfo[0]->support_request_id)->get();
       // dd($issueImg);

       $comment=DB::table('help_and_comment')->where('support_request_id',$notificationInfo[0]->support_request_id)->get();
      //dd($comment);

        return view('admin.client.helpReplyForSVP')->with('help_info',$helpInfo)->with('svp_info',$svpInfo)->with('issue_type',$issueType)->with('issue_image',$issueImg)->with("_comment",$comment);
    }

    public function store2(Request $request,$id){
      //  $getCommentInfo=DB::table('help_and_comment')->where('support_request_id',$id)->get();
        //dd($getCommentInfo);
        
      // dd((int)$id);
         // dd($request->comment);
         $validator = Validator::make($request->all(), [
            'comment' => 'required|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/notification/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
         $getNotificationInfo=DB::table('notifications')->where('support_request_id',$id)->get();
   // dd($getNotificationInfo);
        //dd($getNotificationInfo[0]->notification_id);
   
           $commentInfo=new helpAndCommentModel();
           $commentInfo->comment=$request->comment;
           $commentInfo->support_request_id=((int)$id);
           $commentInfo->from_whome=3;
           $commentInfo->service_provider_id=session()->get('svp_id');
           $commentInfo->save();

           $getHelpInfo=DB::table('support_requests')->where('support_request_id',$id)->get();
           //dd($getHelpInfo);

        // support request notification type as 1
        // support request comment notification type as 2

        // get client information from client tabel

          //  dd(session()->get('customer_id'));
            $svpInfo=SVP::where('service_provider_id',session()->get('svp_id'))->get();
            $svpName=$svpInfo[0]->name;
         //  $clientInfo=Client::find('customer_id',session()->get('customer_id'));
          // dd($clientInfo);

             $commentNotification=new Notification();
             $commentNotification->notification="You have a comment of support request from your service provider $svpName";
             $commentNotification->support_request_id=$id;
             $commentNotification->type=2;
             $commentNotification->to_whome=1;
             $commentNotification->from_whome=3;
             $commentNotification->is_read=0;
             $commentNotification->service_provider_id=session()->get('svp_id');
             $commentNotification->save();

             
         
           return redirect('/svp/notification/'.$getNotificationInfo[0]->notification_id);
    

    }
}
