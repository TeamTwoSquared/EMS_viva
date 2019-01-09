<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewing extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'reviewings';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','service_id','customer_id','review_id'];
}
