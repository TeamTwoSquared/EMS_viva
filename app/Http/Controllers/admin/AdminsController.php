<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use App\Admin;

class AdminsController extends Controller
{
    public function index(){
        return view ('admin.index');
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
        
        $admin = Admin::where('email',$email)->get();
    
        if(($admin->count())==0)
        {
            return redirect('/admin/login')->with('error','Invalid Email Address');
        }
        else if(($admin[0]->password)==$pass)
        { 
            session()->put('adminlogged','e86ba6a6ee56b15b9f5982982375b52f');
            session()->put('admin_id',$admin[0]->admin_id);

            return redirect('/admin/dash')->with('success','Logged in Successfully');
        }
        return redirect('/admin/login')->with('error','Invalid Password');
    
    }

    public static function checkLogged($islogin)//islogin means is the method is called from admin.login page
    {
        $mysession = session()->get('adminlogged','null');
        if($mysession != 'e86ba6a6ee56b15b9f5982982375b52f' && !$islogin)
        {
            session()->flash('error','Session Expired, Please Login');
            return false;
        }
        else if($mysession != 'e86ba6a6ee56b15b9f5982982375b52f' && $islogin)
        {
            return false;
        }
        return true;
    }

    public static function getAdmin()
    {
        $admin = Admin::where('admin_id', session()->get('admin_id'))->get();
       return $admin[0];
    }

    public function save_profile(Request $request)
    {
        $this->validate($request, [
            'username'=> 'required',
            'email'=> 'required'
        ]);
        
        $admin = Admin::find(session()->get('admin_id'));
        $admin->username=$request->input('username');
        $admin->email=$request->input('email');
        $admin->save();
        return redirect('/admin/profile')->with('success','Profile Updated');

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
            $image_resize->save(public_path('storage/images/profile/'.$fileNameToStore));
       
        }

        //Adding new pic to DB
        $admin = Admin::find(session()->get('admin_id'));
        if($admin->profilepic=='noimage.jpg')
        { 
            $admin->profilepic=$fileNameToStore;
            $admin->save();
            return redirect('/admin/profile')->with('success','Profile Image Updated');
        }
        else
        {
            // Delete Image
            Storage::delete('public/images/profile/'.$admin->profilepic);
            $admin->profilepic=$fileNameToStore;
            $admin->save();
            return redirect('/admin/profile')->with('success','Profile Image Updated');
        }
    }
    


}//end of class
