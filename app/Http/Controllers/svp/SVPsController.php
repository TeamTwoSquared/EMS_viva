<?php

namespace App\Http\Controllers\svp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\SVP;
use App\TasksSvp;
use App\Http\Controllers\MailController;

class SVPsController extends Controller
{
    public function index(){
        return view ('svp.index');
    }

    public function admin_index()
    {
        $svp = SVP::all();
        return view('admin.svp.svp')->with('svp',$svp);
    }
    public function destroy($id)
    {   
        SVP::where('service_provider_id',$id)->delete();        
        return redirect('/admin/svp');
    }
    public function block($id)
    {
        $svp = SVP::where('service_provider_id',$id)->get();
        $svp = $svp[0];
        if ($svp->isverified==2)
        {
            $svp->isverified=1;
        }
        else if ($svp->isverified==0)
        {
            $svp->isverified=1;
        }
        else
        {
            $svp->isverified=2;
        }
        $svp->save();
        return redirect('/admin/svp');
    }
    //creating new svp by the admin
    public function admin_create()
    {
        return view('admin.svp.svp_create');
    }
    //store the added svp details by admin
    public function admin_new_store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'username'=>'required',
            'email'=> 'required',
            //'password'=>'required',
        ]);
        $existingEmail=SVP::where('email',$request->email)->get();

        if($existingEmail->count()>0 )
        {
            return redirect('/admin/svp/add')->with('error','Email already exists');
        }
            $svp = new SVP();
            if($request->newpassword==null && $request->newpasswordagain==null)
            {
                return redirect('/admin/svp/add')->with('error','Passwords Cannot Be Null');
            }
            elseif($request->newpassword==$request->newpasswordagain)
            {
                $svp->name = $request->username;
                $svp->firstname = $request->fname;
                $svp->lastname = $request->lname;
                $svp->email = $request->email;
                $svp->username = $request->username;
                $svp->password = $request->newpassword;
                $svp->address = $request->address;
                $svp->address2 = $request->address2;
                $svp->city = $request->city;
                $svp->isverified =1;
                $svp->save();
                return redirect('/admin/svp')->with('success','New service provider added');
            }
            else
            {
                return redirect('/admin/svp/add')->with('error','Passwords Are Not Matching');
            }
    }
    public function admin_edit($id)
    {
        $svp = (SVP::where('service_provider_id',$id)->get())[0];
        return view('admin.svp.svp_update')->with('svp',$svp);
    }
    //store the updated svp details by admin
    public function admin_edit_store(Request $request,$id)
    {
            $svp = SVP::find($id);
            
            if($request->newpassword==null && $request->newpasswordagain=null)
            {
                $svp->name = $request->username;
                $svp->firstname = $request->fname;
                $svp->lastname = $request->lname;
                $svp->email = $request->email;
                $svp->username = $request->username;
                $svp->address = $request->address;
                $svp->address2 = $request->address2;
                $svp->city = $request->city;
                $svp->isverified =1;
                $svp->save();
                return redirect('/admin/svp')->with('success','Service provider details updated');
            }
            else
            {
                if($request->newpassword==$request->newpasswordagain)
                {
                $svp->firstname = $request->fname;
                $svp->lastname = $request->lname;
                $svp->email = $request->email;
                $svp->username = $request->username;
                $svp->password = md5($request->newpassword);
                $svp->address = $request->address;
                $svp->address2 = $request->address2;
                $svp->city = $request->city;
                $svp->isverified =1;
                $svp->save();
                return redirect('/admin/svp')->with('success','Service provider details updated');
                }
                elseif($request->newpassword!=$request->newpasswordagain)
                {
                return redirect('/admin/svp')->with('error',"New Password and Confirmation Password Aren't matching");
                }
            }
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'username'=>'required',
            'email'=> 'required',
            'password'=> 'required'
        ]);
        
        $_svp =SVP::where('email',$request->email)->get();
        $_svpSameUser = SVP::where('username',$request->username)->get();
    
        if(($_svp->count())==0 && ($_svpSameUser->count()==0))
        {
            $svp=new SVP();
            $svp->name=$request->username;
            $svp->username=$request->username;
            $svp->password=md5($request->password);
            $svp->email=$request->email;
            $svp->save();
            SVPsController::sendActivationLink($svp->service_provider_id);
            //session()->put('new_svp',$svp->service_provider_id);
            return redirect('/svp/toverify');
            
        }
        else
        {
            if(($_svp->count()>0) && ($_svpSameUser->count()>0))
            {
                return redirect('/svp/register')->with('error','Both Username & Email are Already Exist, Please Sign In !!');
        
            }
            else if(($_svp->count()>0) && ($_svpSameUser->count()==0))
            {
                return redirect('/svp/register')->with('error','Your Email Address is Already Exist, Please Sign In !!');
            }
            else if (($_svp->count()==0) && ($_svpSameUser->count()>0))
            {
                return redirect('/svp/register')->with('error','Selected Username is Already Exist, Please Try Another !!');
            }
        }

        
    }
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required',
            'password'=> 'required'
        ]);
        
        
        $email = $request->email;
        $pass = $request->password;
        $pass = md5($pass);
        
        $svp = SVP::where('email',$email)->get();
    
        if(($svp->count())==0)
        {
            return redirect('/svp/login')->with('error','Invalid Email Address');
        }
        else if(($svp[0]->password)==$pass)
        {
            session()->put('svplogged','e86ba6a6ee56b15b9f5982982375b52f');
            session()->put('svp_id',$svp[0]->service_provider_id);
            if($svp[0]->isverified == 1) 
            {
                return redirect('/svp/dash')->with('success','Logged in Successfully');
            }
            else
            {
                return redirect('/svp/toverify')->with('error','Your Account is not verified');
            }
        }
        return redirect('/svp/login')->with('error','Invalid Password');
    
    }
    public static function checkLogged($islogin)//islogin means is the method is called from svp.login page
    {
        $mysession = session()->get('svplogged','null');
        if($mysession != 'e86ba6a6ee56b15b9f5982982375b52f' && !$islogin)
        {
            session()->flash('error','Session Expired, Please Login');
            return false;
        }
        else if($mysession != 'e86ba6a6ee56b15b9f5982982375b52f' && $islogin)
        {
            return false;
        }
        $svp=SVPsController::getSVP();
        if($svp->isverified==1){
            return true;
        }
        return false;
    }

    public static function getSVP()
    {
        $svp = SVP::where('service_provider_id', session()->get('svp_id'))->get();
        return $svp[0];
    }

    public function change_img(Request $request)
    {
        //validation
        $this->validate($request, 
        [
            'profile_image'=>'required|image|max:1999'
        ]);

         // Handle File Upload
         if($request->hasFile('profile_image'))
         {
            // Get filename with the extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload 
            $image       = $request->file('profile_image');
            //$path = $request->file('profile_image')->storeAs('public/images/profile', $fileNameToStore);
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(100, 100);
            $image_resize->save(public_path('storage/images/profile/' .$fileNameToStore));
       
        }

        //Adding new pic to DB
        $svp = SVP::find(session()->get('svp_id'));
        if($svp->profilepic=='noimage.jpg')
        { 
            $svp->profilepic=$fileNameToStore;
            $svp->save();
            return redirect('/svp/profile')->with('success','Profile Image Updated');
        }
        else
        {
            // Delete Image
            Storage::delete('public/images/profile/'.$svp->profilepic);
            $svp->profilepic=$fileNameToStore;
            $svp->save();
            return redirect('/svp/profile')->with('success','Profile Image Updated');
        }
    }

    public static function sendActivationLink($svp_id)
    {
        $svp=SVP::find($svp_id);
        //Check already verified
        if($svp->isverified==1)
        {
            return redirect('/svp/login')->with('warning','Your Account is Already Active');
        }
        
        //Generate Activation Link and Add to DB
        else
        {
            $uniqueString =  unique_random('service_providers', 'activation_link', 40);
            $svp->activation_link=$uniqueString;
            $svp->save();
            //Send Activation Link
            MailController::send_verify(1,$svp);
            session()->put('svp_id',$svp->service_provider_id);
            return redirect('/svp/toverify');
        }   
    }

    public function doVerify($id, $key)
    {
        $svp=SVP::find($id);
        if($svp->isverified == 1) 
        {
           return redirect('/svp/login')->with('warning','Your Account is Already Activated, Please Login');
        }

        else if($svp->activation_link == $key)
        {
            $svp->isverified = 1;
            $svp->save();
            return redirect('/svp/login')->with('success','Your Account is Activated Sucessfully, Please Login');
        }

        else
        {
            return redirect('/svp/login')->with('error','Invalid Verification Link, Login to Generate a New Link');
        }
    }

    public function save_profile(Request $request){
        $svp = SVP::find(session()->get('svp_id'));
        //Changing Passwords
        //if($request->oldpassword != null && $request->newpassword != null && $request->newpasswordagain != null)
        if($request->oldpassword && $request->newpassword && $request->newpasswordagain)
        {
            $oldpasswordDB=$svp->password;
            $oldpassword=md5($request->oldpassword);
            
            $newpassword=md5($request->newpassword);
            $newpasswordagain=md5($request->newpasswordagain);
        
            if($oldpasswordDB==$oldpassword)
            {
                if($newpassword==$newpasswordagain)
                {
                        $svp->password=md5($request->newpasswordagain);
                        $svp->firstname = $request->fname;
                        $svp->lastname = $request->lname;
                        $svp->address=$request->address;
                        $svp->address2=$request->address2;
                        $svp->city=$request->city;
                        $svp->save();
                        return redirect('/svp/profile')->with('success','Profile Updated');
                }
                else
                {
                    return redirect('/svp/profile')->with('error','Incorrect New Password Confirmation');
                }    
            }
            else
            {
                return redirect('/svp/profile')->with('error','Incorrect Old Password');
            }
            
        }
        else if(!$request->oldpassword && !$request->newpassword && !$request->newpasswordagain)
        {
            $svp->firstname = $request->fname;
            $svp->lastname = $request->lname;
            $svp->address=$request->address;
            $svp->address2=$request->address2;
            $svp->city=$request->city;
            $svp->save();
            return redirect('/svp/profile')->with('success','Profile Updated');
        }
        else
        {
            return redirect('/svp/profile')->with('error','All 3 Fields, Old Password, New Password and Confirmation Password Are Needed');
        }
       
   }

    public function isOnline($id){
        $svp=SVP::where('service_provider_id',$id)->get();
        if($svp[0]->isonline == 1){
            return "Active Now";
        }
        else{
            return " Off line";
        }
    }

    public function logout(){
        $svp = SVP::find(session()->get('svp_id'));
        $svp->isonline=0;
        $svp->save();
        session()->flush();
        return redirect('/svp/login')->with('success','Logged out Succesfully');
    }
    
    public static function getSVP2($id)
    {
        return SVP::find($id);
    }

    public function client_view($id)
    {
        return view('client.showSVP')->with('svp_id',$id);
    }

    public static function getAllSVPCount()
    {
        $svp = SVP::all();
        return $svp->count();
    }

    public function delete(Request $request,$id){
        $svpInfo=SVP::find($id);
      //  dd($svpInfo->isdeleted);
        if(md5($request->pass)==($svpInfo->password)){
            $svpInfo->isdeleted=1;
            $svpInfo->save();
            return redirect('/')->with('success','Your account has been deleted !');
        }
        else{
            return redirect('/svp/profile')->with('error','Incorrect password !');
        }
        
    }

    public function checkDeleted(Request $request){
       // SVP::where->('email',$request->email)->where('password',md5($request->password))->get();
        dd($request);
    }

}//end of class