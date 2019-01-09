<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientEvent extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'customer_events';
   
    // Primary Key
    public $primaryKey = ['customer_id','event_id'];
}
