<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVP extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'service_providers';
   
    // Primary Key
    public $primaryKey = 'service_provider_id';
}
