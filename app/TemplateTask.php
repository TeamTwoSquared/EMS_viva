<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateTask extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'template_tasks';
   
    // Primary Key
    public $primaryKey = ['template_id','task_id'];
}
