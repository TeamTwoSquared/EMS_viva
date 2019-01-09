@extends('layouts.admin')
@section('content')
@php
use App\Template;
use App\TemplateImage;
use App\TemplateKeyword;
use App\CatergoryTemplate;
use App\Http\Controllers\event\CatergoriesController;
use App\Http\Controllers\event\CatergoryTemplatesController;
use App\Http\Controllers\event\TemplateImagesController;
$savedCatergories=CatergoryTemplatesController::getCatergoriesTemp($template->template_id);
$allCatergories = CatergoriesController::getCatergories();
$i=1;//use to have checkbox number
$templateImages = TemplateImagesController::getImages($template->template_id);
$j=1; //Use to have cover image number
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <strong>Update</strong> Template
            </div>
            <div class="card-body card-block">
                <form  onsubmit="return confirm('Do you really want to update the template {{$template->name}}')" action="update/{{$template->template_id}}"method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class="form-control-label">Template Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" value="{{$template->name}}" maxlength="30" class="form-control" >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Description</div>
                        <div class="col-12 col-md-9">
                            <textarea name="description" id="description" rows="3"  maxlength="250" class="form-control">{{$template->description}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">Keywords</div>
                        <div class="col-12 col-md-9">
                        <textarea style="text-transform:uppercase" name="keywords" id="keywords" rows="2" class="form-control">@foreach($templateKeywords as $templateKeyword){{$templateKeyword->keyword}}{{","}}@endforeach</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class="form-control-label">Catergories</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-check">
                                @foreach($allCatergories as $catergory)
                                    <div class="checkbox">
                                    <label for="checkbox_{{$i}}" class="form-check-label">
                                            <input type="checkbox" id="{{$catergory->name}}" name="catergories[]" value="{{$catergory->catergory_id}}"  class="form-check-input" >{{$catergory->name}}
                                        </label>
                                    </div>
                                    @php
                                      $i++;  
                                    @endphp
                                @endforeach
                                @foreach($savedCatergories as $catergory)
                                    <script>
                                        document.getElementById("{{$catergory->name}}").checked = true;
                                    </script>
                                @endforeach                                
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3" data-pg-collapsed>
                            <label class="form-control-label">Cover Images</label>
                        </div>
                        <div class="form-check" data-pg-collapsed>
                            <section class="content-block gallery-2">
                                <div class="container">
                                    <div class="row">
                                    @foreach($templateImages as $templateImage)
                                        <div class="col-md-4" data-pg-collapsed>
                                            <img src="/storage/images/template/{{$templateImage->imgurl}}" alt="Template Image.{{$j}}"/>
                                            <div class="checkbox text-center mt-1">
                                                <label for="checkbox_{{$j}}" class="form-check-label">
                                                    <input type="checkbox" id="{{$templateImage->imgurl}}" name="delete_images[]" value="{{$templateImage->imgurl}}"  class="form-check-input" >Delete Me
                                                </label>
                                            </div>
                                        </div>
                                    @php
                                    $j++;  
                                    @endphp
                                    @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.container -->
                            </section>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">New Cover Images&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="template_new_images" name="template_new_images[]" multiple class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer">
                            <button type="update"class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Update
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