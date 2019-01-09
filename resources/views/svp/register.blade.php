@extends('layouts.svp_login')

@section('content')
<div class="login-wrap" data-pg-collapsed> 
    <div class="login-content bg-ems-admin border-ems-admin"> 
        <div class="login-logo"> 
            <a href="#"> 
                <img src="images/icon/logo.png" alt="EMS"> 
            </a>             
        </div>         
        <div class="login-form"> 
            <form action="doregister" method="post"> 
                {{ csrf_field() }}
                <div class="form-group"> 
                    <label class="text-white font-weight-bold">Username</label>                     
                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username"> 
                </div>                 
                <div class="form-group"> 
                    <label class="text-white font-weight-bold">Email Address</label>                     
                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email"> 
                </div>                 
                <div class="form-group"> 
                    <label class="font-weight-bold text-white">Password</label>                     
                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password"> 
                </div>                 
                <div class="login-checkbox"> 
</div>                 
                <button class="au-btn au-btn--block au-btn--green m-b-20 text-body font-weight-bold" type="submit">register</button>                 
            </form>             
            <div class="register-link"> 
                <p class="text-white"> 
                                    Already have account? <a href="login" class="text-warning">Sign In</a> </p> 
            </div>             
        </div>         
    </div>     
</div>
@endsection