<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateKeyword extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    // Table Name
    protected $table = 'template_keywords';
   
    // Primary Key
    public $primaryKey = ['template_id','keyword'];
}
