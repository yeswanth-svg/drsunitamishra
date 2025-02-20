<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLang extends Model
{
    use HasFactory;
    protected $fillable = ['page_id','title','content','lang','slug','meta_description','meta_title','meta_tags','og_meta_description','og_meta_title','og_meta_image'];
    
}
