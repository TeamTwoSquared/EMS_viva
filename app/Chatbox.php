<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatbox extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'chatboxs';
   
    // Primary Key
    public $primaryKey = 'chat_id';
}
