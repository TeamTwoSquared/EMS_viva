<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{   

    public $timestamps = false;
    // Table Name
    protected $table = 'admins';
   
    // Primary Key
    public $primaryKey = 'admin_id';
}
