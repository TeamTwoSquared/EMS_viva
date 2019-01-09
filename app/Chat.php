<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'chats';
   
    // Primary Key
    public $primaryKey = 'chat_id';
}
