<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'support_requests';
   
    // Primary Key
    public $primaryKey = 'support_request_id';
}
