<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class helpAndCommentModel extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'help_and_comment';
   
    // Primary Key
    public $primaryKey = ['comment_id'];
}

