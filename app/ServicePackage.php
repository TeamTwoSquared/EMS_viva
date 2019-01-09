<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'package_service';
   
    // Primary Key
    public $primaryKey = 'package_id';
}
