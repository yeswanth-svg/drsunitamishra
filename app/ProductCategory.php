<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['status'];
    
    public function category_all(){
        return $this->hasOne('App\ProductCategoryLang','category_id');
    }
    public function category_front(){
        return $this->hasOne('App\ProductCategoryLang','category_id')->where('lang',front_default_lang());
    }
    public function lang(){
        return $this->hasOne(ProductCategoryLang::class,'category_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(ProductCategoryLang::class,'category_id')->where(['lang' => front_default_lang()]);
    }
 
     public function lang_all(){
         return $this->hasMany(ProductCategoryLang::class,'category_id');//->groupBy('lang');
     }
}
