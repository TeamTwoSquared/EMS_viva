<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVPTel extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_provider_tels';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','tel'];
}
