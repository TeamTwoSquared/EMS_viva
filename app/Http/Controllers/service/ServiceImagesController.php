<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ServiceImagesController extends Controller
{
    public static function store2($request,$id)
    {/*
        //dd($request->profile_image);
        if($request->hasFile('profile_image'))
        {
            $allowedfileExtension=['jpg','png','jpeg','gif'];
            $images = $request->file('profile_image');
            foreach($images as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if(!$check)
                {
                    return redirect()->back()->with('error','Please Upload Image File(s)');
                }
            }
        }
*/
        // save image files

         if($request != null)
         {  
             for($i=0; $i<count($request);$i++)
             {
                 $image = $request[$i];
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
                 $image_resize->resize(800, 600);
                 $image_resize->save(public_path('storage/images/services/' .$fileNameToStore));
                 
                 //Adding URL to template_images table
                 
                 $serviceImg=new ServiceImage();
                // return "123";
                 $serviceImg->service_id=$id;
                 $serviceImg->imgurl=$fileNameToStore;
         
                 $serviceImg->save();
            
             }
        }
        
    }

    public static function edit($id)
    {
        $serviceImg=ServiceImage::where('service_id',$id)->get();
       
    }

    public static function update(Request $request)
    {

       $numOfImg=($request->picture);
       if( $numOfImg != null){
            for($i=0;$i<count($numOfImg);$i++){
                DB::table('service_images')->where('service_id', $request->serviceID)->where('imgurl',$request->picture[$i])->delete();
            }
        }

       if($request->newImage != null)
       {

           for($i=0; $i<count($request->newImage);$i++)
           {
               $image = $request->newImage[$i];
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
               $image_resize->resize(800, 600);
               $image_resize->save(public_path('storage/images/services/' .$fileNameToStore));
               
               //Adding URL to template_images table
               
               $serviceImg=new ServiceImage();
              // return "123";
               $serviceImg->service_id=$request->serviceID;
               $serviceImg->imgurl=$fileNameToStore;
       
               $serviceImg->save();
            }
        }
    }

    public static function getRandomImages($service_id)
    {
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        $size = $serviceImages->count();
        if($size==0)
        {
            return $serviceImages;
        }
        return $serviceImages[rand(0,$size-1)];
    }

    public static function getAllImages($service_id)
    {
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        return $serviceImages;
    }
}