<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'package_type';
   
    // Primary Key
    public $primaryKey = ['package_id','type'];
}
