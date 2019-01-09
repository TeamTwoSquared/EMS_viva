<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksSvp extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'tasks_svps';
}
