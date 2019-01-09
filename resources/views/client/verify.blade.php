@extends('layouts.client_login')

@section('content')
@php
use App\Client;
$client = session()->get('customer_id','null');
if ($client!='null')
{
  $myclient_id = $client;
}
else 
{
  header("Location: /client/login");
  die();
}
@endphp
<div class="login-wrap" data-pg-collapsed> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <div class="row">
        <div class="alert alert-success col-md-12" role="alert" id="notes">
          <h4>NOTES</h4>
          <ul>
            <li>Please confirm your email address using the verification link sent to 
                you. In case it’s missing from your inbox, please check your spam folder.</li>
            <li>If somehow, you did not recieve the verification email then <a href="/clverification/{{$myclient_id}}">resend the verification email</a></li>
          </ul>
        </div>
      </div>     
</div>
@php
session()->flush();   
@endphp
@endsection