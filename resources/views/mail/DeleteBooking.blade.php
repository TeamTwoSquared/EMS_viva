@php
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\svp\SVPsController;
use App\Http\Controllers\event\EventsController;
$booking = BookingsController::getBooking($data['booking_id']);
$svp = SVPsController::getSVP2($booking->service_provider_id);
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
<h1><strong>Booking is Cancled</strong></h1>
<h3>Booking on {{$booking->date}} is cancled by the service provider {{$svp->name}} (email : {{$svp->email}}).</h3>
<h3>If you have any questions, let our support know at <a href="mailto:contact@ems.dv" target="_pg_blank" data-pg-id="97">contact@ems.dv</a>.</h3>
<h3>Sincerely</h3>
<h3>EMS Team.</h3>
<p>
  <a href="{{ config('app.url', 'ems2.dv') }}/client/register">
  <button class="button" style="vertical-align:middle">Join Now</button>
</a> 
</p>
</div>
</body>
</html>
