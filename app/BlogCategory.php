<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['status'];
    
    public function category_lang(){
        return $this->hasMany('App\BlogCategoryLang','category_id');
    }
    public function category_front(){
        return $this->hasOne('App\BlogCategoryLang','category_id')->where('lang',front_default_lang());
    }
    public function lang(){
        return $this->hasOne(BlogCategoryLang::class,'category_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(BlogCategoryLang::class,'category_id')->where(['lang' => front_default_lang()]);
    }
 
     public function lang_all(){
         return $this->hasMany(BlogCategoryLang::class,'category_id');;
     }
    
}
