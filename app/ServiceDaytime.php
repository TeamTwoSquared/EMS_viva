<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDaytime extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_daytimes';
   
    // Primary Key
    public $primaryKey = ['service_id','day','stime','etime'];
}
