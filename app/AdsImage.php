<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsImage extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'ads_images';
   
    // Primary Key
    public $primaryKey = ['ad_id','imgurl','position','isbottom','isright'];
}
