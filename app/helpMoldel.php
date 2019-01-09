<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class helpModel extends Model
{
    protected $guarded  = [];
    public $timestamps = false;
    // Table Name
    protected $table = 'support_request_type';
   
    // Primary Key
    public $primaryKey = ['type_id'];
}
