<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'invitations';
   
    // Primary Key
    public $primaryKey = 'invitation_id';
}
