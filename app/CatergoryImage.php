<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatergoryImage extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'catergory_images';
   
    // Primary Key
    public $primaryKey = ['catergory_id','imgurl'];
}
