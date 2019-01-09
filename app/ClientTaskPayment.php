<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientTaskPayment extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'customer_task_payments';
   
    // Primary Key
    public $primaryKey = ['customer_id','payment_id','service_id','service_provider_id','task_id'];
}
