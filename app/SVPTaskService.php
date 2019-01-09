<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVPTaskService extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'serviceprovider_task_services';
   
    // Primary Key
    public $primaryKey = ['service_provider_id','task_id','service_id'];
}
