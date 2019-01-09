<?php

namespace App\Http\Controllers\ad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdsImage;

class AdImagesController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store()
    {

    }


    public function show($id)
    {
        $ads=AdsImage::where('ad_id',$id)->get();
        $adImages=$ads->imgurl;

        return view('sideAdds\showSideAdds')->with('adImage',$adImages);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public static function getBottomRandomImages($ad_id)
    {
        $adImages=AdsImage::where('ad_id',$ad_id)->where('isbottom',1)->get();
        $size = $adImages->count();
        return $adImages[rand(0,$size-1)];
    }

    public static function getRightRandomImages($ad_id)
    {
        $adImages=AdsImage::where('ad_id',$ad_id)->where('isright',1)->get();
        $size = $adImages->count();
        return $adImages[rand(0,$size-1)];
    }

    public static function getImages($ad_id)
    {
        $adImages=AdsImage::where('ad_id',$ad_id)->get();
        return $adImages;
    }

    public static function getBottomImages($ad_id)
    {
        $adImages=AdsImage::where('ad_id',$ad_id)->where('isbottom',1)->get();
        return $adImages;
    }

    public static function getRightImages($ad_id)
    {
        $adImages=AdsImage::where('ad_id',$ad_id)->where('isright',1)->get();
        return $adImages;
    }
}