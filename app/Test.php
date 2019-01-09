<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'test';
   
    // Primary Key
    public $primaryKey = 'id';
}
