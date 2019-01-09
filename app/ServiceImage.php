<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_images';
   
    // Primary Key
    public $primaryKey = ['service_id','imgurl'];
}
