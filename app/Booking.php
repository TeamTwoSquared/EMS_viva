<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'bookings';
   
    // Primary Key
    public $primaryKey = 'booking_id';
}
