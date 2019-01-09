@extends('layouts.admin')
@section('content')
            <div class="row" data-pg-collapsed> 
                <div class="col-md-12 ml-auto mr-auto"> 
                    <div class="card"> 
                        <div class="card-header"><strong>Update</strong> Client Details</div>             
                        <div class="card-body card-block"> 
                        <form action="update/{{$customer->customer_id}}" method="post" data-pg-collapsed> 
                            {{ csrf_field() }}
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress">Name</label>                         
                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$customer->name}}"> 
                                </div>
                                <div class="form-group"> 
                                    <label for="inputAddress">Username</label>                         
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" value="{{$customer->username}}"> 
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder=""  value="{{$customer->email}}"> 
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
                                    <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{$customer->address}}"> 
                                </div>                     
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress2">Address 2</label>                         
                                    <input type="text" class="form-control" id="address2" name="address2" placeholder="" value="{{$customer->address2}}"> 
                                </div>
                                <div class="form-group" data-pg-collapsed> 
                                    <label for="inputAddress2">City</label>                         
                                    <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{$customer->city}}"> 
                                </div>                     
                                <button type="submit" class="btn btn-success btn-sm">Save Changes</button>                     
                            </form>                 
                        </div>             
                    </div>         
                </div>     
            </div>        
@endsection