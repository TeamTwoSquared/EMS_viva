<?php

namespace App\Http\Controllers\service;
use App\Http\Controllers\event\TasksController;
use App\Http\Controllers\event\TaskKeywordsController;

use App\ServiceLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Http\Controllers\service\ServiceImagesController;
use App\ServiceType;
use App\ServiceKeyword;
use App\ServiceImage;
use App\ServiceVideo;
use App\Task;
use App\TaskKeyword;
use Validator;



class ServicesController extends Controller
{

    public function index()
    {
        $servicesInfo = Service::where('service_provider_id',session()->get('svp_id'))->where('is_package',0)->get();
        return view('svp.services')->with('svpServices',$servicesInfo);
    }


    public function create()
    {
        return view('svp.addServices');
    }


    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|unique:services',
            'description' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/svp/addServices')
                        ->withErrors($validator)
                        ->withInput();
        }



        $exsistingService = Service::where('name',$request->name)->get();
        
        if(count($exsistingService) != 0){
          //  dd($exsistingService);
            return redirect('/svp/service')->with('error','This service is alrady exist !');
        }

        else{
            $service = new Service();
            $service->name = $request->name;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->service_provider_id=session()->get('svp_id');
            $service->save();

            ServiceImagesController::store2($request->service_image,$service->service_id);
            ServiceKeywordsController::store2($request,$service->service_id);
            ServiceLocationsController::store2($request,$service->service_id);
            ServiceTypesController::store2($request,$service->service_id);
            ServiceVideosController::store2($request->service_video_url,$service->service_id);

            return redirect('/svp/service')->with('success','Successfully registered new service !');
        }
    }


    public function show($service_id)
    {
        $serviceInfo=Service::where('service_id',$service_id)->get();
        $serviceLocations=ServiceLocation::where('service_id',$service_id)->get();
        $serviceTypes=ServiceType::where('service_id',$service_id)->get();
        $serviceKeywords=ServiceKeyword::where('service_id',$service_id)->get();
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        $serviceVideos=ServiceVideo::where('service_id',$service_id)->get();
        return view('svp.viewService')->with('service_info',$serviceInfo)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_Images',$serviceImages)->with('service_videos',$serviceVideos);
    }


    public function edit($service_id)
    {
        $service = Service::find($service_id);
        $serviceLocations=ServiceLocation::where('service_id',$service_id)->get();
        $serviceTypes=ServiceType::where('service_id',$service_id)->get();
        $serviceKeywords=ServiceKeyword::where('service_id',$service_id)->get();
        $serviceImages=ServiceImage::where('service_id',$service_id)->get();
        $serviceVideos=ServiceVideo::where('service_id',$service_id)->get();

        $serviceImg=count(ServiceImage::where('service_id',$service_id)->get());
        
        if(count($serviceVideos) != 0){
            return view('svp.editService')->with('service_info',$service)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_images',$serviceImages)->with('service_videos',$serviceVideos[0]->videourl)->with('serviceID',$service_id)->with('service_img',$serviceImg);
        }
        else{
            return view('svp.editService')->with('service_info',$service)->with('service_locations',$serviceLocations)->with('service_types',$serviceTypes)->with('service_keywords',$serviceKeywords)->with('service_images',$serviceImages)->with('service_videos'," ")->with('serviceID',$service_id)->with('service_img',$serviceImg);
        }
    }


    public function update(Request $request)
    {
       // dd($request->picture[2]);


          //  DB::table('services')->update(['service_id'=>($request->serviceID),'name'=>$request->sName , 'price'=>$request->price,'description'=>$request->description ]);

            $updateService=Service::find($request->serviceID);
            $updateService->service_id=$request->serviceID;
            $updateService->name = $request->sName;
            $updateService->price = $request->price;
            $updateService->description = $request->description;
            $updateService->service_provider_id=session()->get('svp_id');
            $updateService->save();
            
             // calling functions

            ServiceKeywordsController::update($request);
            ServiceLocationsController::update($request);
            ServiceTypesController::update($request);
            ServiceVideosController::update($request);
            ServiceImagesController::update($request);

            

            return redirect('/svp/service')->with('success','Successfully Updated The Service !');

    }


    public  function destroy($service_id)
    {
        $serviceDelete = Service::find($service_id);
        $serviceDelete->delete();

        return redirect('/svp/service')->with('success','Successfully Deleted Service !');
    }

    public function client_normal_search(Request $request)//A string is recieved from $request->data
    {
        $keywords = explode(" ",$request->data);
        if($keywords[0]==NULL)
        {
            return redirect()->back()->with('error','Your Search Cannot be Empty');
        }

        $service_list = Array();
        foreach($keywords as $keyword)
        {
            $services = ServiceKeyword::select('service_id')->where('keyword',$keyword)->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);

            $services = Service::select('service_id')->where('description','LIKE', '%'.$keyword.'%')->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);
        }

        
        $service_list = array_collapse($service_list);
        
        $service_id_list = Array();
        foreach($service_list as $element)
        {
            $service_id_list = array_prepend($service_id_list,$element->service_id);
        }
       
        $new_array=array_count_values($service_id_list);
        arsort($new_array);
        
        [$keys, $values] = array_divide($new_array);
        
        return view('client.search')->with('service_ids',$keys);

    }

    public function client_search_text($text)//Search services for a given text
    {
        $keywords = explode(" ",$text);
        if($keywords[0]==NULL)
        {
            return redirect()->back()->with('error','Your Task Name Cannot be Empty');
        }

        $service_list = Array();
        foreach($keywords as $keyword)
        {
            $services = ServiceKeyword::select('service_id')->where('keyword',$keyword)->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);

            $services = Service::select('service_id')->where('description','LIKE', '%'.$keyword.'%')->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);
        }

        
        $service_list = array_collapse($service_list);
        
        $service_id_list = Array();
        foreach($service_list as $element)
        {
            $service_id_list = array_prepend($service_id_list,$element->service_id);
        }
       
        $new_array=array_count_values($service_id_list);
        arsort($new_array);
        
        [$keys, $values] = array_divide($new_array);
        
        return view('client.search')->with('service_ids',$keys);

    }

    public function client_search_id($id)//Search services for a given id
    {
        $task = Task::find($id);
        if($task->istemp == 1)
        {
            $keywords = explode(" ",$task->name);
        }
        else
        {
            $keywords = explode(" ",$task->name);
            $task_keywords = TaskKeyword::select('keyword')->where('task_id',$id)->get();
            foreach($task_keywords as $task_keyword)
            {
                $keywords =  array_prepend($keywords,$task_keyword->keyword);
            }
        }

        $service_list = Array();
        foreach($keywords as $keyword)
        {
            $services = ServiceKeyword::select('service_id')->where('keyword',$keyword)->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);

            $services = Service::select('service_id')->where('description','LIKE', '%'.$keyword.'%')->get();
            if(count($services)!=0) $service_list = array_prepend($service_list,$services);
        }

        
        $service_list = array_collapse($service_list);
        
        $service_id_list = Array();
        foreach($service_list as $element)
        {
            $service_id_list = array_prepend($service_id_list,$element->service_id);
        }
       
        $new_array=array_count_values($service_id_list);
        arsort($new_array);
        
        [$keys, $values] = array_divide($new_array);
        
        return view('client.searchTask')->with('service_ids',$keys)->with('task_id',$id);

    }

    public function client_view($id)
    {
        return view('client.showService')->with('service_id',$id);
    }

    public function client_view2($service_id,$task_id)
    {
        return view('client.showService')->with('service_id',$service_id)->with('task_id',$task_id);
    }

    public static function getService($id)
    {
        return Service::find($id);
    }

    public static function getServicesExceptOne($svp_id,$service_id)
    {
        $services = Service::where('service_provider_id',$svp_id)->whereNotIn('service_id',Array($service_id))->take(4)->get();
        return $services;
    }

    public static function getServices($svp_id)
    {
        $services = Service::where('service_provider_id',$svp_id)->get();
        return $services;
    }

    public function getReservationModal($service_id, $svp_id,$task_id=0)
    {
        return view('client.reservation')->with('service_id',$service_id)->with('service_provider_id',$svp_id)->with('task_id',$task_id);
    }

    public static function getAllCount()
    {
        return Service::all()->count();
    }

}