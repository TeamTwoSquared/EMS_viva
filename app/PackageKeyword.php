<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageKeyword extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'package_keywords';
   
    // Primary Key
    public $primaryKey = ['package_id','keyword'];
}
