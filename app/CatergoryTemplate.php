<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatergoryTemplate extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'catergory_templates';
   
    // Primary Key
    public $primaryKey = ['catergory_id','template_id'];
}
