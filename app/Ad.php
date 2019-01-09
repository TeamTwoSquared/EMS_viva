<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'ads';
   
    // Primary Key
    public $primaryKey = 'ad_id';
}
