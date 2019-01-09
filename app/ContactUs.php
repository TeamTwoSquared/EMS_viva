<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'contact_us';
   
    // Primary Key
    public $primaryKey = 'Feedback_no';
}
