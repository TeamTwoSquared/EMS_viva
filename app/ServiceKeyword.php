<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceKeyword extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_keywords';
   
    // Primary Key
    public $primaryKey = ['service_id','keyword'];
}
