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
use Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services|regex:/[a-zA-Z]+$/u',
            'description' => 'required|max:100|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/packageService')
                        ->withErrors($validator)
                        ->withInput();
        }

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
                $keyword = new PackageKeyword();
                $keyword->package_id=$id;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }
    }

    public function uploadingLocations(Request $request , $id){

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
 
                 $location = new PackageLocation();
                 $location->package_id=$id;
                 $location->location=$locations;
                 $location->save();
             }
         }
    }

    public function uploadingTypes(Request $request,$id){

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
                $type = new PackageType();
                $type->package_id=$id;
                $type->type=$types;
                $type->save();
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

          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:services|regex:/[a-zA-Z]+$/u',
            'description' => 'required|max:100|regex:/[a-zA-Z]+$/u',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/packageService')
                        ->withErrors($validator)
                        ->withInput();
        }

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
                 
                 return redirect('/svp/packageService')->with('error','Please upload and image'); 
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
                $keyword = new PackageKeyword();
                $keyword->package_id=$id;
                $keyword->keyword=$keywords;
                $keyword->save();
            }
        }  
    }

    public function updateLocations(Request $request,$id){
        $findlocations=PackageLocation::where('package_id',$id)->get();
        //dd($findlocations);
         foreach($findlocations as $location){
             DB::table('package_location')->where('package_id', $id)->where('location',$location->location)->delete();
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
 
                 $location = new PackageLocation();
                 $location->package_id=$id;
                 $location->location=$locations;
                 $location->save();
             }
         }
    }

    public function updateTypes(Request $request,$id){
        $findType=PackageType::where('package_id',$id)->get();
        //dd($findlocations);
         foreach($findType as $type){
             DB::table('package_type')->where('package_id', $id)->where('type',$type->type)->delete();
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
                $type = new PackageType();
                $type->package_id=$id;
                $type->type=$types;
                $type->save();
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
