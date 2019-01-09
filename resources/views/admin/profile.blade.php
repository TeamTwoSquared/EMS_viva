@extends('layouts.admin')
@section('content')
@php
use App\Http\Controllers\admin\AdminsController;
if(!(AdminsController::checkLogged(0))){
header("Location: /admin/login");
die();
}
$admin=AdminsController::getAdmin();
@endphp
<div class="row" data-pg-collapsed>
    <div class="col-md-9 mr-auto ml-auto">
        <div class="card">
            <div class="card-header">Change your Account Details</div>
            <div class="card-body card-block">
                <form action="save_profile" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                        <input type="text" id="username" name="username" value="{{$admin->username}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{$admin->email}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row" data-pg-collapsed>
    <div class="col-md-9 mr-auto ml-auto">
        <div class="card">
            <div class="card-header">Change your Profile Picture</div>
            <div class="card-body card-block">
                <form action="change_img" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-actions form-group">
                        <input type="file" id="profile_image" name="profile_image" class="form-control-file">
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Upload Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection