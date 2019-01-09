<?php

namespace App\Http\Controllers\service\packageService;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServicePackage;
use App\PackageKeyword;
use App\PackageLocation;
use App\PackageType;
use App\ServiceKeyword;

class packageController extends Controller
{
    public function index(){
        $packageInfo = ServicePackage::where('service_provider_id',session()->get('svp_id'))->get();
        return view('svp.package')->with('packageService',$packageInfo);
    }

    public function create(){
        return view('svp.addPackage');
    }

    public function store(Request $request){

        $exsistingServicePackage = ServicePackage::where('name',$request->name)->get();
        
        if(count($exsistingServicePackage) != 0){
            return redirect('/svp/packageService')->with('error','This service package is alrady exist !');
        }

        else{
            $servicePack = new ServicePackage();
            $servicePack->name = $request->name;
            $servicePack->price = $request->price;
            $servicePack->description = $request->description;
            $servicePack->service_provider_id=session()->get('svp_id');

            if($request->Package_image != null)
            {  
           
                 $image = $request->Package_image;
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
                 
                 $servicePack->imgurl=$fileNameToStore;   
             }

             if($request->package_video_url != null){
                 $servicePack->videourl=$request->package_video_url;
             }

             $servicePack->save();

             // uploading keywords..

            $this->uploadingKeywords($request,$servicePack->package_id);
            $this->uploadingTypes($request,$servicePack->package_id);
            $this->uploadingLocations($request,$servicePack->package_id);
    
            return redirect('/svp/packageService')->with('success','Successfully registered new service package !');
        }
    }

    public static function uploadingKeywords(Request $request,$id){
        
        for($i=1;$i<7;$i++) {
            $a="keyword";
            $a =$a.$i;
        
            if(($request->$a) != null){
                        $key = new PackageKeyword();
                        $a="keyword";
                        $a =$a.$i;
                        $key->package_id = $id;
                        $key->keyword = $request->$a;
                        $key->save();
            }
        }
    }

    public function uploadingLocations(Request $request , $id){
        for($i=7;$i<13;$i++) {
            $a="location";
            $a =$a.$i;
            if(($request->$a) != null){   
                $loc = new PackageLocation();
                $a="location";
                $a =$a.$i;
                $loc->package_id = $id;
                $loc->location= $request->$a;
                $loc->save();
            }
        }
    }

    public function uploadingTypes(Request $request,$id){

        for($i=13;$i<19;$i++) {
            $a="type";
            $a =$a.$i;
            if(($request->$a) != null){
                $types = new PackageType();
                $a="type";
                $a =$a.$i;
                $types->package_id = $id;
                $types->type= $request->$a;
                $types->save();
            }
        }    
    }


    public function show($package_id){
        $packageInfo=ServicePackage::where('package_id',$package_id)->get();
        $packageLocations=PackageLocation::where('package_id',$package_id)->get();
        $packageTypes=PackageType::where('package_id',$package_id)->get();
        $packageKeywords=PackageKeyword::where('package_id',$package_id)->get();
       // $serviceImages=ServiceImage::where('package_id',$package_id)->get();
       // $serviceVideos=ServiceVideo::where('package_id',$package_id)->get();
        return view('svp.viewPackage')->with('package_info',$packageInfo)->with('package_locations',$packageLocations)->with('package_types',$packageTypes)->with('package_keywords',$packageKeywords);
    }

    public function edit($package_id){
        $packageInfo=ServicePackage::where('package_id',$package_id)->get();
        $packageLocations=PackageLocation::where('package_id',$package_id)->get();
        $packageTypes=PackageType::where('package_id',$package_id)->get();
        $packageKeywords=PackageKeyword::where('package_id',$package_id)->get();
       // $serviceImages=ServiceImage::where('package_id',$package_id)->get();
       // $serviceVideos=ServiceVideo::where('package_id',$package_id)->get();
        return view('svp.editPackage')->with('package_info',$packageInfo)->with('package_locations',$packageLocations)->with('package_types',$packageTypes)->with('package_keywords',$packageKeywords);
        
    }

    public function update(Request $request,$package_id){
         //   dd($request);
          // dd((int)$package_id);
            $updatePackage=ServicePackage::find($package_id);
            $updatePackage->package_id=((int)$package_id);
            $updatePackage->name = $request->name;
            $updatePackage->price = $request->price;
            $updatePackage->description = $request->description;
            $updatePackage->videourl = $request->videorul;
            $updatePackage->service_provider_id=session()->get('svp_id');

            $numOfImg=($request->picture);
         //  dd($numOfImg[0]);
          //  if($numOfImg[0] != null){
               // dd($numOfImg[0]);
                // DB::table('package_service')->where('package_id', $package_id)->where('imgurl',$numOfImg[0])->delete();    
         //   }

            
            $newImage=($request->package_image);
           // dd($x);
            if($newImage != null)
            {  
               // dd($request->package_image);
                 $image = ($request->package_image);
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
                 
                 $updatePackage->imgurl=$fileNameToStore;   
             }
             if($request->package_image == null)
            {  
                 //Adding URL to template_images table
                 
                 $updatePackage->imgurl='No_Image_Available.jpg';   
             }

             $this->updateKeywords($request,$package_id);
             $this->updateLocations($request,$package_id);
             $this->updateTypes($request,$package_id);
 

            $updatePackage->save();
           
            return redirect('/svp/packageService')->with('success','Successfully Updated The Package !');
    }

    public function updateKeywords(Request $request,$id){
        
        $findKeywords=PackageKeyword::where('package_id',$id)->get();
         foreach($findKeywords as $keyword){
             DB::table('package_keywords')->where('package_id', $id)->where('keyword',$keyword->keyword)->delete();
        }

        for($i=7;$i<13;$i++) {
            $a="keyword";
            $a =$a.$i;
        
            if(($request->$a) != null){
                        $key = new PackageKeyword();
                        $a="keyword";
                        $a =$a.$i;
                        $key->package_id = $id;
                        $key->keyword = $request->$a;
                        $key->save();
            }
        }     
    }

    public function updateLocations(Request $request,$id){
        $findlocations=PackageLocation::where('package_id',$id)->get();
        //dd($findlocations);
         foreach($findlocations as $location){
             DB::table('package_location')->where('package_id', $id)->where('location',$location->location)->delete();
        }

        for($i=1;$i<7;$i++) {
            $a="location";
            $a =$a.$i;
        
            if(($request->$a) != null){
                        $loc = new PackageLocation();
                        $a="location";
                        $a =$a.$i;
                        $loc->package_id = $id;
                        $loc->location = $request->$a;
                        $loc->save();
            }
        }
    }

    public function updateTypes(Request $request,$id){
        $findType=PackageType::where('package_id',$id)->get();
        //dd($findlocations);
         foreach($findType as $type){
             DB::table('package_type')->where('package_id', $id)->where('type',$type->type)->delete();
        }

        for($i=13;$i<19;$i++) {
            $a="type";
            $a =$a.$i;
        
            if(($request->$a) != null){
                        $typ = new PackageType();
                        $a="type";
                        $a =$a.$i;
                        $typ->package_id = $id;
                        $typ->type = $request->$a;
                        $typ->save();
            }
        }
    }


    public  function destroy($package_id)
    {
        $packageDelete = ServicePackage::find($package_id);
        $packageDelete->delete();

        return redirect('/svp/packageService')->with('success','Successfully Deleted The Package !');
    }
}
