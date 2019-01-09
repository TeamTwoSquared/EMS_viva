<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'notifications';
   
    // Primary Key
    public $primaryKey = 'notification_id';
}
