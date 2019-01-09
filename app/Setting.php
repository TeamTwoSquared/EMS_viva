<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'settings';
   
    // Primary Key
    public $primaryKey = 'setting_id';
}
