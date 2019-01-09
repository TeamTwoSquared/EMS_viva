@php
use App\Http\Controllers\service\servicesController;
use App\Http\Controllers\svp\SVPsController;
use App\Http\Controllers\BookingsController;

$booking = BookingsController::getBooking($data['booking_id']);
$svp = SVPsController::getSVP();
$services=$data['services'];
@endphp

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to EMS</title>
<style type="text/css">
.button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    background-color: #f78d6c;
    color: white;
    font-size: 16px;
    padding: 16px 30px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    text-align: center;
}

.button:hover {
    background-color: #f4511e;
    color: white;
}
</style>
</head>

<body>
<div style="padding-left:20px">
<center>
  <p><img src="{{ config('app.url', 'ems2.dv') }}/mail/images/logo.png" alt="EMS Logo" name="img_logo" width="381" height="184" id="img_logo" /></p></center>
<h1><strong>Welcome To EMS</strong></h1>
<h3>Dear valuable customer,</h3>
<h3>A booking on <strong>{{$booking->date}}</strong> was made by <strong>{{$svp->name}}</strong> for the following services,</h3>
@foreach ($services as $service)
  @php
    $service = ServicesController::getService($service);
  @endphp  
    	<h3>•{{$service->name}}</h3>
  @endforeach
<h3>please take a minute to register/login to EMS by clicking the button below:</h3>
<h3>*If you cannot open the link, copy and paste this link into your browser:<a href = "{{ config('app.url', 'ems2.dv') }}">{{ config('app.url', 'ems2.dv') }}</a></h3>
<h3>If you have any questions, let our support know at <a href="mailto:contact@ems.dv" target="_pg_blank" data-pg-id="97">contact@ems.dv</a>.</h3>
<h3>Sincerely</h3>
<h3>EMS Team.</h3>
<p>
  <a href="{{ config('app.url', 'ems2.dv') }}">
  <button class="button" style="vertical-align:middle">Join Now</button>
</a> 
</p>
</div>
</body>
</html>
