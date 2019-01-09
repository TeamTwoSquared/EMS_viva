<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTemplateTask extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'event_template_tasks';
   
    // Primary Key
    public $primaryKey = ['event_id','task_id'];

}
