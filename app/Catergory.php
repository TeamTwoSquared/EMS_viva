<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catergory extends Model
{
    public $timestamps = false;
    // Table Name
    protected $table = 'catergories';
   
    // Primary Key
    public $primaryKey = 'catergory_id';
}
