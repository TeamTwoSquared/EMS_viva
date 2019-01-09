<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    public static function getAdPrice($type)
    {
        if($type == 0 )//For bottom Ad
        {
            $value = Setting::select('value')->where('property','bottom_ad_price')->get();
            return $value[0];
        }
        else
        {
            $value = Setting::select('value')->where('property','right_ad_price')->get();
            return $value[0];
        }
    }

    public static function getPayHereDetails()
    {
        $merchant_id = Setting::select('value')->where('property','merchant_id')->get()[0]->value;
        $merchant_secret = Setting::select('value')->where('property','merchant_secret')->get()[0]->value;
        $payhere_action = Setting::select('value_string')->where('property','payhere_action')->get()[0]->value_string;

        $payhere = Array('merchant_id' => $merchant_id,'merchant_secret' => $merchant_secret, 'payhere_action' => $payhere_action );
        return $payhere;
    }

    public static function getMaxRightAds()
    {
        $num = Setting::select('value')->where('property','max_right_ads')->get()[0]->value;
        return $num;
    }

    public static function getMaxBottomAds()
    {
        $num = Setting::select('value')->where('property','max_bottom_ads')->get()[0]->value;
        return $num;
    }

    public function save_payhere(Request $request)
    {
        $this->validate($request, [
            'merchant_id'=> 'required',
            'merchant_secret'=> 'required',
            'url'=> 'required'
        ]);
        
        $merchant_id = Setting::find(4);
        $merchant_secret = Setting::find(5);
        $url = Setting::find(6);

        $merchant_id->value = $request->merchant_id;
        $merchant_id->save();
        $merchant_secret->value = $request->merchant_secret;
        $merchant_secret->save();
        $url->value_string = $request->url;
        $url->save();


        return redirect('/admin/settings')->with('success','PayHere configurations are saved');
    }

    public function save_adConfig(Request $request)
    {
        $this->validate($request, [
            'right_price'=> 'required',
            'right_num'=> 'required',
            'bottom_price'=> 'required',
            'bottom_num'=> 'required'
        ]);
        
        if ($request->right_price<0 || $request->right_num<0 || $request->bottom_price<0 || $request->bottom_num<0) return redirect('/admin/settings')->with('error','Please enter non negative integers for all 4 fields');
        $right_ad_price = Setting::find(3);
        $bottom_ad_price = Setting::find(2);
        $right_ad_max = Setting::find(7);
        $bottom_ad_max = Setting::find(8);
        
        $right_ad_price->value = $request->right_price;
        $bottom_ad_price->value = $request->bottom_price;
        $right_ad_max->value = $request->right_num;
        $bottom_ad_max->value = $request->bottom_num;

        $right_ad_price->save();
        $bottom_ad_price->save();
        $right_ad_max->save();
        $bottom_ad_max->save();

        return redirect('/admin/settings')->with('success','Ad configurations are saved');
    }
    
}
