<?php

namespace App\Http\Controllers\event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TemplateKeyword;

class TemplateKeywordsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public static function destroy($id)
    {   
        // remove all Keywords belong to a template
        return TemplateKeyword::where('template_id',$id)->delete();
    }
}