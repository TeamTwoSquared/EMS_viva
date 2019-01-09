<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageLocation extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'package_location';
   
    // Primary Key
    public $primaryKey = ['package_id','location'];
}
