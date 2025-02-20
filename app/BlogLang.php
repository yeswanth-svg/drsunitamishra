<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLang extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id','title','slug','lang','author', 'tags','content','meta_title','meta_tags','meta_description','og_meta_title','og_meta_description','og_meta_image', 'image'];
}
