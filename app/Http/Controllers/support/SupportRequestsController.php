<?php

namespace App\Http\Controllers\support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SupportRequest;

class SupportRequestsController  extends Controller
{

    public function index()
    {
        return view('supportRequest.index');
    }


    public function create()
    {
        return view('supportRequest.create');
    }


    public function store(Request $request)
    {
        $supportRequest = new SupportRequest();
        $supportRequest->type = $request->type;
        $supportRequest->request = $request->request;
        $supportRequest->customer_id = $request->customer_id;
        $supportRequest->service_provider_id = $request->service_provider_id;
        $supportRequest->from_whome=2;
        $supportRequest->save();
    }


    public function show($id)
    {
        $supportRequest = SupportRequest::find($id);
        return $supportRequest; 
    }


    public function edit($id)
    {
        $supportRequest = SupportRequest::find($id);
        return view('supportRequest.edit')->with('supportRequest'.$supportRequest);
    }


    public function update(Request $request, $id)
    {
        $supportRequest = SupportRequest::find($id);
        $supportRequest->type = $request->type;
        $supportRequest->request = $request->request;
        $supportRequest->customer_id = $request->customer_id;
        $supportRequest->service_provider_id = $request->service_provider_id;
        $supportRequest->save();
    }


    public function destroy($id)
    {
        $supportRequest = SupportRequest::find($id);
        $supportRequest->delete();
    }
}