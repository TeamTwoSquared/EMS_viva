@extends('layouts.svp')
@section('content')
@php
use App\Http\Controllers\svp\SVPsController;
if(!(SVPsController::checkLogged(0))){
header("Location: /svp/login");
die();
}
$svp=SVPsController::getSVP();
@endphp
<section class="statistic"> 
    <div class="section__content section__content--p30"> 
        <div class="container-fluid">
            <div class="row" data-pg-collapsed> 
                <div class="col-md-9 mr-auto ml-auto"> 
                    <div class="card"> 
                        <div class="card-header"><strong>Change</strong> your Account Details</div>             
                        <div class="card-body card-block"> 
                            <form action="save_profile" method="post" data-pg-collapsed> 
                            {{ csrf_field() }}
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress">First Name</label>                         
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="{{$svp->firstname}}"> 
                                </div>
                                <div class="form-group" data-pg-collapsed> 
                                        <label for="inputAddress">Last Name</label>                         
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="{{$svp->lastname}}"> 
                                </div>
                                <div class="form-group"> 
                                    <label for="inputAddress">Username</label>                         
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" disabled value="{{$svp->username}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" disabled value="{{$svp->email}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">Old Password</label>
                                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Type your old password"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">New Password</label>
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Type your new password"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">Confirm New Password</label>
                                    <input type="password" class="form-control" id="newpasswordagain" name="newpasswordagain" placeholder="Type your new password again"> 
                                </div>
                                <div class="form-group"> 
                                    <label for="inputAddress">Address</label>                         
                                    <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{$svp->address}}"> 
                                </div>                     
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress2">Address 2</label>                         
                                    <input type="text" class="form-control" id="address2" name="address2" placeholder="" value="{{$svp->address2}}"> 
                                </div>
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress2">City</label>                         
                                    <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{$svp->city}}"> 
                                </div>                     
                                <button type="submit" class="btn btn-success btn-sm">Save Changes</button>                     
                            </form>                 
                        </div>             
                    </div>         
                </div>     
            </div>



            <div class="row" data-pg-collapsed>
                <div class="col-md-9 mr-auto ml-auto">
                    <div class="card">
                        <div class="card-header"><strong>Change</strong> your Profile Picture</div>
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

            
        </div>
    </div>
</section>            
@endsection