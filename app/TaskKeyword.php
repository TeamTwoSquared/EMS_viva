<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskKeyword extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'task_keywords';
   
    // Primary Key
    public $primaryKey = ['task_id','keyword'];
}
