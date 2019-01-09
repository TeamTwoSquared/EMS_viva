<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'payments';
   
    // Primary Key
    public $primaryKey = 'payment_id';
}
