@extends('layouts.admin_login')

@section('content')
<div class="login-wrap" data-pg-collapsed> 
    <div class="login-content bg-ems-admin border-ems-admin"> 
        <div class="login-logo bg-ems-admin border-ems-admin"> 
            <a href="#"> 
                <img src="images/icon/logo.png" alt="EMSAdmin"> 
            </a>             
        </div>         
        <div class="login-form"> 
            <form action="dologin" method="post"> 
                {{ csrf_field() }}
                <div class="form-group"> 
                    <label class="text-light font-weight-bold">Email Address</label>                     
                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email"> 
                </div>                 
                <div class="form-group"> 
                    <label class="text-light font-weight-bold">Password</label>                     
                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password"> 
                </div>                                  
                <button class="au-btn au-btn--block au-btn--green m-b-20 font-weight-bold text-body" type="submit">sign in</button>                 
            </form>             
        </div>         
    </div>     
</div>
@endsection