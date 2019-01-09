@extends('layouts.admin')
@section('content')
@php
use App\Http\Controllers\admin\AdminsController;
use App\Setting;
if(!(AdminsController::checkLogged(0))){
header("Location: /admin/login");
die();
}
$merchant_id = Setting::find(4);
$merchant_secret = Setting::find(5);
$url = Setting::find(6);
$admin=AdminsController::getAdmin();
$right_ad_price = Setting::find(3);
$bottom_ad_price = Setting::find(2);
$right_ad_max = Setting::find(7);
$bottom_ad_max = Setting::find(8);
@endphp
<div class="row" data-pg-collapsed>
    <div data-pg-collapsed class="col-md-12">
        <div class="card" data-pg-collapsed>
            <div class="card-header">
                <strong>PayHere</strong> Configurations
            </div>
            <div class="card-body card-block">
                <form action="/admin/settings/payhere" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">PayHere Merchant ID</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="text-input" name="merchant_id" class="form-control" value="{{$merchant_id->value}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">PayHere Mechant Secret</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="email-input" name="merchant_secret" placeholder="" class="form-control" value="{{$merchant_secret->value}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">PayHere Action URL</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="email-input" name="url" placeholder="" class="form-control" value="{{$url->value_string}}">
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
        <div class="card" data-pg-collapsed>
            <div class="card-header">
                <strong>Ads</strong> Configurations
            </div>
            <div class="card-body card-block" data-pg-collapsed>
                <form action="/admin/settings/ads" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group" data-pg-collapsed>
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Right Pane Ad Price</label>
                        </div>
                        <div class="col-12 col-md-9">
                        <input type="number" id="text-input" name="right_price" class="form-control" value="{{$right_ad_price->value}}">
                        </div>
                    </div>
                    <div class="row form-group" data-pg-collapsed>
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Max Right Pane Ads</label>
                        </div>
                        <div class="col-12 col-md-9">
                        <input type="number" id="email-input" name="right_num" placeholder="" class="form-control" value="{{$right_ad_max->value}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Bottom Pane Ad Price</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="email-input" name="bottom_price" placeholder="" class="form-control" value="{{$bottom_ad_price->value}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Max Bottom Pane Ads</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="email-input" name="bottom_num" placeholder="" class="form-control" value="{{$bottom_ad_max->value}}">
                        </div>
                    </div>
                    <div class="card-footer" data-pg-collapsed>
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