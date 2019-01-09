<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'reviews';
   
    // Primary Key
    public $primaryKey = 'review_id';
}
