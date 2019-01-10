<?php

namespace App\Http\Controllers\service\packageService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\ServicePackage;
use App\PackageKeyword;
use App\PackageLocation;
use App\PackageType;
use App\ServiceKeyword;
use App\packageAndServicesModel;
use App\Service;
use App\ServiceImage;
use App\ServiceLocation;
use App\ServiceType;
use App\ServiceVideo;
use Validator;



class packageServiceController extends Controller
{
    public function index1($package_id){
        $packageService=packageAndServicesModel::where('package_id',$package_id)->get();
       // $serviceInfo=Service::where('service_id',($packageService[0]->service_id))->get();
       // dd($packageService);
        return view('svp.serviceIntoPackages')->with('package_service_info',$packageService)->with('package_id',$package_id);
    }

    public function create($package_id){
        $package_id=((int)$package_id);
        //dd($package_id);
        return view('svp.addSevicesIntoPackages')->with('package_id',$package_id);
    }

    public function store(Request $request,$package_id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services|regex:/[a-zA-Z]+$/u',
            'description' => 'required|max:100|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/package/addServices/'.$package_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $package_id=((int)$package_id);
       // dd($request);

        $exsistingService = Service::where('name',$request->name)->get();
        
        if(count($exsistingService) != 0){
            return redirect('/svp/package/addServices/'.$package_id)->with('error','This service is alrady exist !');
        }

        else{
            $service = new Service();
            $service->name = $request->name;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->service_provider_id=session()->get('svp_id');
            $service->is_package=1;
            $service->save();

            $packageAndService=new packageAndServicesModel();
            $packageAndService->package_id=$package_id;
            $packageAndService->service_id=$service->service_id;
            $packageAndService->save();

            
            $this->uploadImages($request->service_image,$service->service_id);
            $this->keywords($request,$service->service_id);
            $this->locations($request,$service->service_id);
            $this->serviceTypes($request,$service->service_id);
            $this->videoUrl($request->service_video_url,$service->service_id);

            return redirect('/svp/packageService/'.$package_id)->with('success','Successfully registered new service !');
        }

    }


    public  function uploadImages($request,$id)
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
                 $image_resize->resize(460, 310);
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

    public  function keywords($request, $id){

        // define an array.

        $key=array();
        
        //  put all the values into array

        for($i=1;$i<7;$i++) {
            $a="keyword";
            $a =$a.$i;
            $key[$i]=($request->$a);
        }

        // get distinct vlues into array

        $key = array_unique($key);

        // store those values..
        foreach($key as $keywords){
            if($keywords != null){
                $keyword = new ServiceKeyword();
                $keyword->service_id=$id;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }
    }

    public  function locations($request,$id)
    {

         // define an array..
         $loc=array();

         // put all the locations into array..
 
         for($i=7;$i<13;$i++) {
             $a="location";
             $a =$a.$i;
             $loc[$i-6]=($request->$a);
         }
 
         // get destinct values of array..
         $loc = array_unique($loc);
 
         // store those values in the database
 
         foreach($loc as $locations){
             if($locations != null){
 
                 $location = new ServiceLocation();
                 $location->service_id=$id;
                 $location->location=$locations;
                 $location->save();
             }
         }
    }

    public  function serviceTypes($request,$id)
    {

         // define an array.

         $type=array();
        
         //  put all the values into array
 
         for($i=13;$i<19;$i++) {
             $a="type";
             $a =$a.$i;
             $type[$i-12]=($request->$a);
         }
 
         // get distinct vlues into array
 
         $type = array_unique($type);
 
         // store those values..
         
         foreach($type as $types){
             if($types != null){
                 $type = new ServiceType();
                 $type->service_id=$id;
                 $type->type=$types;
                 $type->save();
             }
         }    
    }

    public  function videoUrl($request,$id)
    {
        if($request != null) {
          
                $service_video = new ServiceVideo();
                $service_video->service_id = $id;
                $service_video->videourl = $request;
                $service_video->save();
        
        }
    }


    public function show1($package_id,$service_id)
    {
        $serviceInfo=Service::where('service_id',$service_id)->get();
        $serviceLocations=ServiceLocation::where('service_id',$service_id)->get();
        $serviceTypes=ServiceType::where('service_id',$service_id)->get();
        $serviceKeywords=ServiceKeyword::where('service_id',$service_id)->get();
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        $serviceVideos=ServiceVideo::where('service_id',$service_id)->get();
        return view('svp.viewPackageService')->with('service_info',$serviceInfo)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_Images',$serviceImages)->with('service_videos',$serviceVideos)->with('package_id',$package_id);
    }

    public function edit1($package_id,$service_id)
    {
        $service = Service::find($service_id);
        $serviceLocations=ServiceLocation::where('service_id',$service_id)->get();
        $serviceTypes=ServiceType::where('service_id',$service_id)->get();
        $serviceKeywords=ServiceKeyword::where('service_id',$service_id)->get();
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        $serviceVideos=ServiceVideo::where('service_id',$service_id)->get();

        $serviceImg=count(ServiceImage::where('service_id',$service_id)->get());
    
        
        if(count($serviceVideos) != 0){
            return view('svp.editPackageServices')->with('service_info',$service)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_images',$serviceImages)->with('service_videos',$serviceVideos[0]->videourl)->with('serviceID',$service_id)->with('service_img',$serviceImg)->with('package_id',$package_id);
        }
        else{
            return view('svp.editPackageServices')->with('service_info',$service)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_images',$serviceImages)->with('service_videos'," ")->with('serviceID',$service_id)->with('service_img',$serviceImg)->with('package_id',$package_id);
        }
    }


    public function update(Request $request,$package_id,$service_id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services|regex:/[a-zA-Z]+$/u',
            'description' => 'required|max:100|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/package/addServices/'.$package_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateService=Service::find($request->serviceID);
        $updateService->service_id=$request->serviceID;
        $updateService->name = $request->sName;
        $updateService->price = $request->price;
        $updateService->description = $request->description;
        $updateService->service_provider_id=session()->get('svp_id');
        $updateService->save();

        // calling functions

        $this->updateKeywords($request);
        $this->updateLocations($request);
        $this->updateTypes($request);
        $this->updateVideoUrl($request);
        $this->updateImages($request);

        return redirect('/svp/packageService/'.$package_id)->with('success','Successfully Updated The Service !');
    }

    public function updateKeywords(Request $request)
    {
        $findKeywords=ServiceKeyword::where('service_id',$request->serviceID)->get();
         foreach($findKeywords as $keyword){
             DB::table('service_keywords')->where('service_id', $request->serviceID)->where('keyword',$keyword->keyword)->delete();
        }

        // define an array.

        $key=array();
        
        //  put all the values into array

        for($i=7;$i<13;$i++) {
            $a="keyword";
            $a =$a.$i;
            $key[$i-6]=($request->$a);
        }

        // get distinct vlues into array

        $key = array_unique($key);

        // store those values..
        foreach($key as $keywords){
            if($keywords != null){
                $keyword = new ServiceKeyword();
                $keyword->service_id=$request->serviceID;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }   
    }

    public  function updateLocations(Request $request)
    {
        $findlocations=ServiceLocation::where('service_id',$request->serviceID)->get();
        //dd($findlocations);
         foreach($findlocations as $location){
             DB::table('service_locations')->where('service_id', $request->serviceID)->where('location',$location->location)->delete();
        }


         // define an array..
         $loc=array();

         // put all the locations into array..
 
         for($i=1;$i<7;$i++) {
             $a="location";
             $a =$a.$i;
             $loc[$i]=($request->$a);
         }
 
         // get destinct values of array..
         $loc = array_unique($loc);
 
         // store those values in the database
 
         foreach($loc as $locations){
             if($locations != null){
 
                 $location = new ServiceLocation();
                 $location->service_id=$request->serviceID;
                 $location->location=$locations;
                 $location->save();
             }
         }
    }

    public  function updateTypes(Request $request)
    {
        $findType=ServiceType::where('service_id',$request->serviceID)->get();
        //dd($findlocations);
         foreach($findType as $type){
             DB::table('service_types')->where('service_id', $request->serviceID)->where('type',$type->type)->delete();
        }

         // define an array.

         $type=array();
        
         //  put all the values into array
 
         for($i=13;$i<19;$i++) {
             $a="type";
             $a =$a.$i;
             $type[$i-12]=($request->$a);
         }
 
         // get distinct vlues into array
 
         $type = array_unique($type);
 
         // store those values..
         
         foreach($type as $types){
             if($types != null){
                 $type = new ServiceType();
                 $type->service_id=$request->serviceID;
                 $type->type=$types;
                 $type->save();
             }
         }
    }
   

    public function updateVideoUrl(Request $request)
    {
    
        $findUrl=ServiceVideo::where('service_id',$request->serviceID)->get();
        
        if(count($findUrl) != 0){
            $find_url=$findUrl[0];
            DB::table('service_videos')->where('service_id', $request->serviceID)->where('videourl',$find_url->videourl)->delete();

        }
        if(($request->url) != null) {
          
            $service_video = new ServiceVideo();
            $service_video->service_id = $request->serviceID;
            $service_video->videourl = $request->url;
            $service_video->save();
    
        }
    }

    public function updateImages(Request $request)
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
               $image_resize->resize(460, 310);
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
    
    public function addExsistingServices($package_id){
        $services = DB::table('services')->where('service_provider_id',session()->get('svp_id'))->where('is_package',0)->where('is_add_to_package',0)->get();
      //  dd($services);
      // $service_images=DB::table('service_images')->where('service_id',$services[0]->service_id)->get();
     //  dd($service_images);
        return view('svp.addExsistingServices')->with('service_info',$services)->with('package_id',$package_id);

    }

    public function addExsistingServicesToPackage(Request $request,$package_id){
      //  dd(count($request->service));
        for($i=0;$i<count($request->service);$i++){
            $addToPack=new packageAndServicesModel();
            $addToPack->package_id=$package_id;
            $addToPack->service_id=$request->service[$i];
            $addToPack->save();

            $service=Service::where('service_id',$request->service[$i])->first();
           // $updateService=($service[0]);
            //dd($service);
            $service->service_id=$service->service_id;
            $service->name=$service->name;
            $service->price=$service->price;
            $service->description=$service->description;
            $service->isavailable=$service->isavailable;
            $service->service_provider_id=$service->service_provider_id;
            $service->is_package=$service->is_package;
            $service->is_add_to_package=1;
            $service->save();
        }
        
        return redirect('/svp/packageService/'.$package_id)->with('success','Successfully Added To The Package');
    }

    public  function destroy($package_id,$service_id)
    {
        $serviceDelete = DB::table('package_and_their_services')->where('service_id', $service_id)->where('service_id',$service_id)->delete();

        $service=Service::where('service_id',$service_id)->first();
        // $updateService=($service[0]);
         //dd($service);
         $service->service_id=$service->service_id;
         $service->name=$service->name;
         $service->price=$service->price;
         $service->description=$service->description;
         $service->isavailable=$service->isavailable;
         $service->service_provider_id=$service->service_provider_id;
         $service->is_package=$service->is_package;
         $service->is_add_to_package=0;
         $service->save();
       
        return redirect('/svp/packageService/'.$package_id)->with('success','Successfully Deleted Service !');
    }
}