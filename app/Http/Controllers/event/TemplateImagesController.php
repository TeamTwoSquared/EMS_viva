<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TemplateImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class TemplateImagesController extends Controller
{
    public static function destroy($id, $imgurls)
    {
        if($imgurls!=null)
        {
            foreach ($imgurls as $imgurl)
            {
                Storage::delete('public/images/template/'.$imgurl);
            }
            return TemplateImage::where('template_id',$id)->whereIn('imgurl',$imgurls)->delete();
        }
    }

    public static function getImages($template_id)
    {
        $templateImages=TemplateImage::where('template_id',$template_id)->get();
        return $templateImages;
    }

    public static function getRandomImages($template_id)
    {
        $templateImages=TemplateImage::where('template_id',$template_id)->get();
        $size = $templateImages->count();
        if($size==0)
        {
            return $templateImages;
        }
        return $templateImages[rand(0,$size-1)];
    }
}
