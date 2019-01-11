<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Client;
use App\Http\Controllers\MailController;


class ClientsController extends Controller
{

    public function index()
    {
        return view ('client.index');
    }

    public function admin_index()
    {
        $customers = Client::all();
        return view('admin.client.client')->with('customers',$customers);
    }

    public function destroy($id)
    {   
        
        Client::where('customer_id',$id)->delete();        
        return redirect('/admin/client');
        
    }
    //blocks clients
    public function block($id)
    {
        $customer = Client::where('customer_id',$id)->get();
        $customer = $customer[0];
        if ($customer->isverified==2)
        {
            $customer->isverified=1;
        }
        else if ($customer->isverified==0)
        {
            $customer->isverified=1;
        }
        else
        {
            $customer->isverified=2;
        }
        $customer->save();
        return redirect('/admin/client');
    }
    //create client by admin
    public function admin_create()
    {
        return view('admin.client.client_create');
    }
    
    //storing created client by admin
    public function admin_new_store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'username'=>'required',
            'email'=> 'required',
            //'password'=>'required',
        ]);
        

        $existingEmail=Client::where('email',$request->email)->get();

        if($existingEmail->count()>0 )
        {
            return redirect('/admin/client/add')->with('error','Email already exists');
        }
        else
        {

            $client = new Client();
            if($request->newpassword==null && $request->newpasswordagain==null)
            {
                return redirect('/admin/client/add')->with('error','Passwords Cannot Be Null');
            }
            elseif($request->newpassword==$request->newpasswordagain)
            {
                $client->name = $request->username;
                $client->email = $request->email;
                $client->username = $request->username;
                $client->password = $request->newpassword;
                $client->address = $request->address;
                $client->address2 = $request->address2;
                $client->city = $request->city;
                $client->isverified =1;
                $client->save();
                return redirect('/admin/client')->with('success','New client added');
            }
            else
            {
                return redirect('/admin/client/add')->with('error','Passwords Are Not Matching');
            }
        }
        // else
        // {
        //     return redirect('/admin/client')->with('error','All 2 Fields New Password and Confirmation Password Are Needed');
        // }
    }

    public function admin_edit($id)
    {
        $customer = (Client::where('customer_id',$id)->get())[0];
        return view('admin.client.client_update')->with('customer',$customer);
    }

    public function admin_edit_store(Request $request,$id)
    {
        
        $this->validate($request, [
            'name'=>'required',
        ]);
        $client=Client::find($id);

        if($request->newpassword==null && $request->newpasswordagain==null)
        {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->username = $request->username;
            $client->address = $request->address;
            $client->address2 = $request->address2;
            $client->city = $request->city;
            $client->save();
            return redirect('/admin/client')->with('success','client updated');
        }
        else
        {
            if($request->newpassword==$request->newpasswordagain)
        {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->username = $request->username;
            $client->password = md5($request->newpassword);
            $client->address = $request->address;
            $client->address2 = $request->address2;
            $client->city = $request->city;
            $client->save();
            return redirect('/admin/client')->with('success','client updated');
        }
            elseif($request->newpassword!=$request->newpasswordagain)
        {
            return redirect('/admin/client')->with('error','New Password and Confirmation Password Are Not Matching');
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
        
        $_client =Client::where('email',$request->email)->get();
        $_clientSameUser = Client::where('username',$request->username)->get();
    
        if(($_client->count())==0 && ($_clientSameUser->count()==0))
        {
            $client=new Client();
            $client->name=$request->username;
            $client->username=$request->username;
            $client->password=md5($request->password);
            $client->email=$request->email;
            $client->save();
            ClientsController::sendActivationLink($client->customer_id);
            //session()->put('new_client',$client->customer_id);
            return redirect('/client/toverify');
            
        }
        else
        {
            if(($_client->count()>0) && ($_clientSameUser->count()>0))
            {
                return redirect('/client/register')->with('error','Both Username & Email are Already Exist, Please Sign In !!');
        
            }
            else if(($_client->count()>0) && ($_clientSameUser->count()==0))
            {
                return redirect('/client/register')->with('error','Your Email Address is Already Exist, Please Sign In !!');
            }
            else if (($_client->count()==0) && ($_clientSameUser->count()>0))
            {
                return redirect('/client/register')->with('error','Selected Username is Already Exist, Please Try Another !!');
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
        
        $client = Client::where('email',$email)->get();
    
        if(($client->count())==0)
        {
            return redirect('/client/login')->with('error','Invalid Email Address');
        }
        else if(($client[0]->password)==$pass)
        {
            session()->put('clientlogged','d7c74c92ce048f6e1f33c7122ad64823');
            session()->put('customer_id',$client[0]->customer_id);
            if($client[0]->isverified == 1) 
            {
                return redirect('/client/dash')->with('success','Logged in Successfully');
            }
            else
            {
                return redirect('/client/toverify')->with('error','Your Account is not verified');
            }
        }
        return redirect('/client/login')->with('error','Invalid Password');
    
    }

    public static function checkLogged($islogin)//islogin means is the method is called from client.login page
    {
        $mysession = session()->get('clientlogged','null');
        if($mysession != 'd7c74c92ce048f6e1f33c7122ad64823' && !$islogin)
        {
            session()->flash('error','Session Expired, Please Login');
            return false;
        }
        else if($mysession != 'd7c74c92ce048f6e1f33c7122ad64823' && $islogin)
        {
            return false;
        }
        $client=ClientsController::getClient();
        if($client->isverified==1){
            return true;
        }
        return false;
    }

    public static function getClient()
    {
        $client = Client::where('customer_id', session()->get('customer_id'))->get();
        return $client[0];
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
        $client = Client::find(session()->get('customer_id'));
        if($client->profilepic=='noimage.jpg')
        { 
            $client->profilepic=$fileNameToStore;
            $client->save();
            return redirect('/client/profile')->with('success','Profile Image Updated');
        }
        else
        {
            // Delete Image
            Storage::delete('public/images/profile/'.$client->profilepic);
            $client->profilepic=$fileNameToStore;
            $client->save();
            return redirect('/client/profile')->with('success','Profile Image Updated');
        }
    }

    public static function sendActivationLink($client_id)
    {
        $client=Client::find($client_id);
        //Check already verified
        if($client->isverified==1)
        {
            return redirect('/client/login')->with('warning','Your Account is Already Active');
        }
        
        //Generate Activation Link and Add to DB
        else
        {
            $uniqueString =  unique_random('customers', 'activation_link', 40);
            $client->activation_link=$uniqueString;
            $client->save();
            //Send Activation Link
            MailController::send_verify(0,$client);
            session()->put('customer_id',$client->customer_id);
            return redirect('/client/toverify');
        }   
    }

    public function doVerify($id, $key)
    {
        $client=Client::find($id);
        if($client->isverified == 1) 
        {
           return redirect('/client/login')->with('warning','Your Account is Already Activated, Please Login');
        }

        else if($client->activation_link == $key)
        {
            $client->isverified = 1;
            $client->save();
            return redirect('/client/login')->with('success','Your Account is Activated Sucessfully, Please Login');
        }

        else
        {
            return redirect('/client/login')->with('error','Invalid Verification Link, Login to Generate a New Link');
        }
    }

    public function save_profile(Request $request){
        $client = Client::find(session()->get('customer_id'));
        //Changing Passwords
        //if($request->oldpassword != null && $request->newpassword != null && $request->newpasswordagain != null)
        if($request->oldpassword && $request->newpassword && $request->newpasswordagain)
        {
            $oldpasswordDB=$client->password;
            $oldpassword=md5($request->oldpassword);
            
            $newpassword=md5($request->newpassword);
            $newpasswordagain=md5($request->newpasswordagain);
        
            if($oldpasswordDB==$oldpassword )
            {
                if($newpassword==$newpasswordagain)
                {
                        $client->password=md5($request->newpasswordagain);
                        $client->name = $request->name;
                        $client->address=$request->address;
                        $client->address2=$request->address2;
                        $client->city=$request->city;
                        $client->save();
                        return redirect('/client/profile')->with('success','Profile Updated');
                }
                else
                {
                    return redirect('/client/profile')->with('error','Incorrect New Password Confirmation');
                }    
            }
            else
            {
                return redirect('/client/profile')->with('error','Incorrect Old Password');
            }
            
        }
        else if(!$request->oldpassword && !$request->newpassword && !$request->newpasswordagain)
        {
            $client->name = $request->name;
            $client->address=$request->address;
            $client->address2=$request->address2;
            $client->city=$request->city;
            $client->save();
            return redirect('/client/profile')->with('success','Profile Updated');
        }
        else
        {
            return redirect('/client/profile')->with('error','All 3 Fields, Old Password, New Password and Confirmation Password Are Needed');
        }
       
   }

    public function isOnline($id){
        $client=Client::where('customer_id',$id)->get();
        if($client[0]->isonline == 1){
            return "Active Now";
        }
        else{
            return " Off line";
        }
    }

    public function logout(){
        session()->flush();
        return redirect('/client/login')->with('success','Logged out Succesfully');
    }

    public static function loginUsingId($id)
    {
        session()->put('clientlogged','d7c74c92ce048f6e1f33c7122ad64823');
        session()->put('customer_id',$id);
        
        return redirect('/client/dash')->with('success','Logged in Successfully');
    }

    public static function getAllClientCount(){
        return Client::all()->count();
    }
}