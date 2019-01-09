<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'customers';
   
    // Primary Key
    public $primaryKey = 'customer_id';
}
