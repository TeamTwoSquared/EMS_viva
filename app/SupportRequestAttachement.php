<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportRequestAttachement extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'support_request_attachements';
   
    // Primary Key
    public $primaryKey = ['support_request_id','attachement_url'];
}
