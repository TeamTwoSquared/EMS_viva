<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class packageAndServicesModel extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'package_and_their_services';
   
    // Primary Key
    public $primaryKey = ['package_id','service_id'];
}
