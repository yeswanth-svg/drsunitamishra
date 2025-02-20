<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesLang extends Model
{
    use HasFactory;
    protected $fillable = ['service_id','lang','slug','title','excerpt','description','meta_title','meta_description','meta_tags','og_meta_title','og_meta_description','og_meta_image'];

}
