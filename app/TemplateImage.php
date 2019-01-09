<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateImage extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'template_images';
   
    // Primary Key
    public $primaryKey = ['template_id','imgurl'];
}
