<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'tasks';
   
    // Primary Key
    public $primaryKey = 'task_id';
}
