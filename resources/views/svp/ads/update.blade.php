@extends('layouts.svp')
@section('content')
@php
   use App\Http\Controllers\SettingsController;
   $bottom_ad_price = SettingsController::getAdPrice(0)->value;
   $right_ad_price = SettingsController::getAdPrice(1)->value;
@endphp
<section class="statistic"> 
    <div class="section__content section__content--p30"> 
        <div class="container-fluid">
            <div class="row" data-pg-collapsed>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-pg-collapsed>
                            <strong>Update</strong> An Advertisement
                        </div>
                        <div class="card-body card-block">
                        <form action="/svp/ads/update/{{$ad->ad_id}}" method="post" enctype="multipart/form-data" class="form-horizontal" data-pg-collapsed>
                                {{ csrf_field() }}
                                <div class="row form-group" data-pg-collapsed>
                                    <div class="col col-md-3">
                                        <label for="text-input" class="form-control-label">Advertisement Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" placeholder="Name your advertisement" class="form-control" value="{{$ad->title}}">
                                    </div>
                                </div>
                                <div class="row form-group" data-pg-collapsed>
                                    <div class="col col-md-3" data-pg-collapsed>
                                        <label for="text-input" class="form-control-label">Type</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="btn-group" data-toggle="buttons"> 
                                                <label class="btn btn-secondary active"> 
                                                    <input type="radio" name="ad_type" id="picture_ad" value = "0" autocomplete="off" checked> Picture Ad        
                                                </label>                                 
                                                <label class="btn btn-secondary"> 
                                                    <input type="radio" name="ad_type" id="text_ad" value="1" autocomplete="off" disabled> Text Ad
                                                </label>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12" data-pg-collapsed>
                                        <div class="alert text-center alert-success"> 
                                            <img src="/storage/images/ad/ads_layout.jpg"/>
                                            <p class="text-success font-weight-bold">EMS Ad Placement Layout</p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group" data-pg-collapsed>
                                    <div class="col col-md-3">
                                        <label for="text-input" class="form-control-label">Placement</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="btn-group" data-toggle="buttons"> 

                                            @if($ad->position == 2)
                                                <label class="btn btn-secondary active"> 
                                                    <input type="checkbox" name="position[]" id="position" value="0" checked autocomplete="off" onchange="bottomUpload(this)"> Bottom Pane             
                                                </label>                                 
                                                <label class="btn btn-secondary"> 
                                                    <input type="checkbox" name="position[]" id="position" value="1" checked autocomplete="off" onchange="rightUpload(this)"> Right Pane                
                                                </label>
                                            @elseif($ad->position == 0)
                                                <label class="btn btn-secondary active"> 
                                                    <input type="checkbox" name="position[]" id="position" value="0" checked autocomplete="off" onchange="bottomUpload(this)"> Bottom Pane             
                                                </label>                                 
                                                <label class="btn btn-secondary"> 
                                                    <input type="checkbox" name="position[]" id="position" value="1" autocomplete="off" onchange="rightUpload(this)"> Right Pane                
                                                </label>
                                            @else
                                                <label class="btn btn-secondary active"> 
                                                    <input type="checkbox" name="position[]" id="position" value="0" autocomplete="off" onchange="bottomUpload(this)"> Bottom Pane             
                                                </label>                                 
                                                <label class="btn btn-secondary"> 
                                                    <input type="checkbox" name="position[]" id="position" value="1" checked autocomplete="off" onchange="rightUpload(this)"> Right Pane                
                                                </label>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row" data-pg-collapsed>
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>             
                                                <strong>Important!</strong> All your previously added images will be removed, So please upload new images.            
                                            </div>
                                        </div>
                                </div>
                                @if($ad->position == 2)
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Bottom-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="bottom_ad_images" name="bottom_ad_images[]" multiple class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Right-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="right_ad_images" name="right_ad_images[]" multiple class="form-control-file">
                                        </div>
                                    </div>
                                @elseif($ad->position == 0)
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Bottom-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="bottom_ad_images" name="bottom_ad_images[]" multiple class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Right-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="right_ad_images" name="right_ad_images[]" multiple class="form-control-file" disabled>
                                        </div>
                                    </div>
                                @else
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Bottom-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="bottom_ad_images" name="bottom_ad_images[]" multiple class="form-control-file" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group" data-pg-collapsed>
                                        <div class="col col-md-3">Right-Ad Images&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="right_ad_images" name="right_ad_images[]" multiple class="form-control-file">
                                        </div>
                                    </div>
                                @endif
                                <div class="row form-group" data-pg-collapsed>
                                    <div class="col col-md-3">
                                        <label for="text-input" class="form-control-label">Advertisement URL</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <input type="text" id="ad_url" name="ad_url" placeholder="Ad URL starts with http:// or https://" class="form-control" value="{{$ad->ad_url}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class="form-control-label">Calculated Price Rs. (Monthly)</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                    <input type="text" id="price" name="price" placeholder="Price to pay for the advertisement" class="form-control" readonly="readonly" value="{{$ad->price}}">
                                    </div>
                                </div>
                                <div class="card-footer" data-pg-collapsed>
                                    <button type="submit" name="submitMe" id="submitMe" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit for Approval
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm" onclick="ResetMe()">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var bottom_ad_price = {{$bottom_ad_price}};
    var right_ad_price ={{$right_ad_price}}

    function bottomUpload(obj){
        var field = document.getElementById("bottom_ad_images");
        var price = document.getElementById("price");
        var submitMe = document.getElementById("submitMe");

        if($(obj).is(":checked") && field.disabled == true) {
            field.disabled=false;
            price.value = Number(price.value) + Number(bottom_ad_price);
        }
        else if(!$(obj).is(":checked") && field.disabled == false) {
            field.disabled=true;
            price.value = Number(price.value) - Number(bottom_ad_price);
        }

        if(Number(price.value) == 0) submitMe.disabled = true;
        else submitMe.disabled = false;
    }

    function rightUpload(obj2){
        var Rfield = document.getElementById("right_ad_images");
        if($(obj2).is(":checked") && Rfield.disabled == true) {
            Rfield.disabled=false;
            price.value = Number(price.value) + Number(right_ad_price);
        }
        else if(!$(obj2).is(":checked") && Rfield.disabled == false) {
            Rfield.disabled=true;
            price.value = Number(price.value) - Number(right_ad_price);
        }

        if(Number(price.value) == 0) submitMe.disabled = true;
        else submitMe.disabled = false;
    }

    function ResetMe(){
        var field = document.getElementById("bottom_ad_images");
        var Rfield = document.getElementById("right_ad_images");
        var price = document.getElementById("price");

        field.disabled = false;
        Rfield.disabled = true;
        price.value = Number(bottom_ad_price);
    }

</script>

@endsection