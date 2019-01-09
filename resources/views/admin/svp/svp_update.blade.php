@extends('layouts.admin')
@section('content')

            <div class="row" data-pg-collapsed> 
                <div class="col-md-12 ml-auto mr-auto"> 
                    <div class="card"> 
                        <div class="card-header"><strong>Update</strong> Service Provider Details</div>             
                        <div class="card-body card-block"> 
                            <form action="update/{{$svp->service_provider_id}}" method="post" data-pg-collapsed> 
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
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" value="{{$svp->username}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder=""  value="{{$svp->email}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">New Password</label>
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Type new password"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">Confirm New Password</label>
                                    <input type="password" class="form-control" id="newpasswordagain" name="newpasswordagain" placeholder="Type new password again"> 
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
@endsection