<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteFee extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'site_fees';
   
    // Primary Key
    public $primaryKey = 'site_fee_id';
}
