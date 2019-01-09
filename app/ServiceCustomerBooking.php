<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCustomerBooking extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_customer_bookings';
   
    // Primary Key
    public $primaryKey = ['service_id','customer_id','booking_id'];
}
