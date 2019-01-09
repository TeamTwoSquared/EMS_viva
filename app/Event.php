<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'events';
   
    // Primary Key
    public $primaryKey = 'event_id';
}
