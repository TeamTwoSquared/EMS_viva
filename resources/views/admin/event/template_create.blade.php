@extends('layouts.admin')
@section('content')
@php
use App\Http\Controllers\event\CatergoriesController;
$catergories = CatergoriesController::getCatergories();
$i=1; //use to have checkbox number
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <strong>Add</strong> Template
            </div>
            <div class="card-body card-block">
                <form action="store" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class="form-control-label">Template Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="" class="form-control" maxlength="30">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Description</div>
                        <div class="col-12 col-md-9">
                            <textarea name="description" id="description" rows="3"  maxlength="250" placeholder="Give a breif description..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Keywords</div>
                        <div class="col-12 col-md-9">
                            <textarea style="text-transform:uppercase" name="keywords" id="keywords" rows="2" placeholder="Enter the keywords which describes the template, each seperated by a space..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label">Catergories</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-check">
                                @foreach($catergories as $catergory)
                                    <div class="checkbox">
                                    <label for="checkbox_{{$i}}" class="form-check-label">
                                            <input type="checkbox" id="catergories" name="catergories[]" value="{{$catergory->catergory_id}}" class="form-check-input">{{$catergory->name}}
                                        </label>
                                    </div>
                                    @php
                                      $i++;  
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Cover Images&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="template_images" name="template_images[]" multiple class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection