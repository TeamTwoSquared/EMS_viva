<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceVideo;
use Illuminate\Support\Facades\DB;

class ServiceVideosController extends Controller
{
    public static function store2($request,$id)
    {
        if($request != null) {
          
                $service_video = new ServiceVideo();
                $service_video->service_id = $id;
                $service_video->videourl = ServiceVideosController::getYoutubeEmbedUrl($request);
                $service_video->save();
        
        }
    }

    public static function update(Request $request)
    {
    
        $findUrl=ServiceVideo::where('service_id',$request->serviceID)->get();
        
        if(count($findUrl) != 0){
            $find_url=$findUrl[0];
            DB::table('service_videos')->where('service_id', $request->serviceID)->where('videourl',$find_url->videourl)->delete();

        }
        if(($request->url) != null) {
          
            $service_video = new ServiceVideo();
            $service_video->service_id = $request->serviceID;
            $service_video->videourl = ServiceVideosController::getYoutubeEmbedUrl($request->url);
            $service_video->save();
    
        }
    }

    public static function getVideos($service_id)
    {
        $serviceVideos=ServiceVideo::where('service_id',$service_id)->get();
        return $serviceVideos;
    }

    public static function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
}