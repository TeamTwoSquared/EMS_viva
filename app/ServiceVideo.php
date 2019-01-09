<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceVideo extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_videos';
   
    // Primary Key
    public $primaryKey = ['service_id','videourl'];
}
