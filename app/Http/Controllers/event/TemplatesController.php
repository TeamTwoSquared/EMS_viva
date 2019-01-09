<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Template;
use App\TemplateKeyword;
use App\TemplateImage;
use App\CatergoryTemplate;
use App\Event;
use App\Http\Controllers\event\CatergoryTemplatesController;
use App\Http\Controllers\event\TemplateImagesController;
use App\Http\Controllers\event\TemplateKeywordsController;
use App\Http\Controllers\event\CatergoriesController;

class TemplatesController extends Controller
{

    public function admin_index()
    {
        //This returns all templates from DB to Template Management of AdminDash
        $templates = Template::all();
        return view('admin.event.template')->with('templates',$templates);
        
    }


    public function admin_create()
    {
        return view('admin.event.template_create');
    }


    public function admin_store(Request $request)
    {
        //Validating submited details
        $this->validate($request, [
            'name'=> 'required',
            'description'=> 'required',
            'keywords'=> 'required',
            'catergories'=> 'required',
            'template_images'=>'nullable|max:1999'
        ]);

        //Checking Whether files are images
        if($request->hasFile('template_images'))
        {
            $allowedfileExtension=['jpg','png','jpeg','gif'];
            $images = $request->file('template_images');
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

        //Storing an template in DB by admin
        $template = new Template();
        $template->name =  $request->name;
        $template->description =  $request->description;
        $template->save();
        //Getting keywords to an array
        $keywords = explode(" ",$request->keywords);
        $keywords = array_map('strtolower',$keywords);
        $keywords = array_unique($keywords);

        foreach($keywords as $keyword)
        {
            //Saving each keyword with template_id
            $templateKeyword = new TemplateKeyword();
            $templateKeyword->template_id = $template->template_id;
            $templateKeyword->keyword = $keyword;
            $templateKeyword->save();
        }
        
        //Saving catergory_template data
        foreach($request->catergories as $catergory)
        {
            $catergoryTemplate = new CatergoryTemplate();
            $catergoryTemplate->catergory_id = $catergory;
            $catergoryTemplate->template_id = $template->template_id;
            $catergoryTemplate->save();
        }

        //Saving images
        if($request->hasFile('template_images'))
        {
            $images = $request->file('template_images');
            foreach($images as $image)
            {
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
                $image_resize->save(public_path('storage/images/template/' .$fileNameToStore));
                
                //Adding URL to template_images table
                $template_image = new TemplateImage();
                $template_image->template_id = $template->template_id;
                $template_image->imgurl = $fileNameToStore;
                $template_image->save();
                
            }
        }
        //On success go and add tasks
        return redirect('/admin/template/');
    }
    public function block($id)
    {
        $template = Template::where('template_id',$id)->get();
        $template = $template[0];
        if ($template->istemp==2)
        {
            $template->istemp=0;
        }
        else if ($template->istemp==0)
        {
            $template->istemp=2;
        }
        else
        {
            $template->istemp=0;
        }
        $template->save();
        return redirect('/admin/template');
    }


    public function show($id)
    {
        //
    }


    public function admin_edit($id)
    {
        $template = (Template::where('template_id',$id)->get())[0];
        $templateKeywords=TemplateKeyword::where('template_id',$id)->get();
        $catergoryTemplates=CatergoryTemplate::where('template_id',$id)->get();
        return view('admin.event.template_update')->with('template',$template)->with('templateKeywords',$templateKeywords)->with('catergoryTemplates',$catergoryTemplates);
        //return view('test')->with('template',$template)->with('catergoryTemplate',$catergoryTemplate);
        //return ($templateKeyword);
    }


    public function admin_update(Request $request, $id)
    {
        //Validating submited details
        $this->validate($request, [
            'name'=> 'required',
            'description'=> 'required',
            'keywords'=> 'required',
            'catergories'=> 'required',
            'delete_images' => 'nullable',
            'template_new_images'=>'nullable|max:1999'
        ]);

        //Checking Whether files are images
        if($request->hasFile('template_new_images'))
        {
            $allowedfileExtension=['jpg','png','jpeg','gif'];
            $images = $request->file('template_new_images');
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

        //Storing an template in DB by admin
        $template = Template::findOrFail($id);
        $template->template_id = $id;
        $template->name =  $request->name;
        $template->description =  $request->description;
        $template->push();
        //Getting keywords to an array
        $keywords = explode(" ",$request->keywords);
        $keywords = array_map('strtolower',$keywords);
        $keywords = array_unique($keywords);
        TemplateKeywordsController::destroy($id);
        foreach($keywords as $keyword)
        {
            //Saving each keyword with template_id
            $templateKeyword = new TemplateKeyword();
            $templateKeyword->template_id = $template->template_id;
            $templateKeyword->keyword = $keyword;
            $templateKeyword->save();
        }
        CatergoryTemplatesController::destroy($id);
        //Saving catergory_template data
        foreach($request->catergories as $catergory)
        {
            $catergoryTemplate = new CatergoryTemplate();
            $catergoryTemplate->catergory_id = $catergory;
            $catergoryTemplate->template_id = $template->template_id;
            $catergoryTemplate->save();
        }
        //Deleting selected images to be deleted
        TemplateImagesController::destroy($id, $request->delete_images);
        //Saving images
        if($request->hasFile('template_new_images'))
        {   
            $images = $request->file('template_new_images');
            foreach($images as $image)
            {
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
                $image_resize->save(public_path('storage/images/template/' .$fileNameToStore));
                
                //Adding URL to template_images table
                $template_image = new TemplateImage();
                $template_image->template_id = $template->template_id;
                $template_image->imgurl = $fileNameToStore;
                $template_image->save();
                
            }
        }
        //On success go and add tasks
        return redirect('/admin/template/');
    }


    public function destroy($id)
    {   
        $tempImages=TemplateImage::where('template_id',$id)->get();
        if(($tempImages->count())>0)
        {
            foreach($tempImages as $tempImage)
            {
                Storage::delete('public/images/template/'.$tempImage->imgurl);
            }
        }
        Template::where('template_id',$id)->delete();        
        return redirect('/admin/template');
        
    }
    public static function getTemplates()
    {
        //Use to return all templates as an Array
        $templates = Template::all();
        return $templates;
    }
    public static function test($id)
    {
        $template = (Template::where('template_id',$id)->get())[0];
        $savedCatergories=CatergoryTemplatesController::getCatergoriesTemp($template->template_id);
        $allCatergories = CatergoriesController::getCatergories();
        
    }

    public function step1_index($catergory_id)//Manage event of new one
    {
        $template_ids = CatergoryTemplatesController::getTemplates($catergory_id);
        $templates = Template::whereIn('template_id',$template_ids)->where('istemp',0)->get();
        return view('client.event.step1')->with('templates',$templates);
    }

    public function client_index($template_id)//Manage event of new one
    {
        $default_template = Template::where('template_id',$template_id)->get();
        session()->put('default_template', $default_template[0]);
        return view('client.event.manage');
    }

    public function client_index2($event_id)
    {
        session()->put('default_event',$event_id);
        return view('client.event.manage')->with('event_id',$event_id);
    }


}//end of class