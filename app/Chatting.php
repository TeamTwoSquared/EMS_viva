<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'chattings';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','customer_id','chat_id'];
}
