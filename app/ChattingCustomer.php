<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChattingCustomer extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'chatting_customers';
   
    // Primary Key
    public $primaryKey = ['customer_id','chat_id','customer_id2'];
}
