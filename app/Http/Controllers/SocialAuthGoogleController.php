<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\client\ClientsController;
use App\Client;
use Socialite;
use Auth;
use Exception;

class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        try {
            
        
            $googleUser = Socialite::driver('google')->user();
            $existUser = Client::where('email',$googleUser->email)->first();
            

            if($existUser) {
                ClientsController::loginUsingId($existUser->id);
            }
            else {
                $user = new Client();
                $user->name = $googleUser->name;
                $user->username = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = md5(rand(1,10000));
                $user->save();
                ClientsController::loginUsingId($user->id);
            }
            //return redirect()->to('/client/login');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }
}
