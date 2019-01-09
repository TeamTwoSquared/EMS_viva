<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'services';
   
    // Primary Key
    public $primaryKey = 'service_id';
}
