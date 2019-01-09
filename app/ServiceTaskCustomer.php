<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTaskCustomer extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'service_task_customers';
   
    // Primary Key
    public $primaryKey = ['service_id','task_id','customer_id'];
}
