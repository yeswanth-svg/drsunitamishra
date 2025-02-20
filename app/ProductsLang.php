<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsLang extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','lang','title','slug','short_description','description','attributes_title','attributes_description','badge','meta_description','meta_title','meta_tags','og_meta_description','og_meta_title','og_meta_image'];

}