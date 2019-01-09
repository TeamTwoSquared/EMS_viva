<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVPKeyword extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_provider_keywords';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','keyword'];
}
