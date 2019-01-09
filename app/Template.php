<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'templates';
   
    // Primary Key
    public $primaryKey = 'template_id';
}
