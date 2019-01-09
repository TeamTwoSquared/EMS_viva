<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVPBookingService extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'serviceprovider_booking_services';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','booking_id','service_id'];
}
