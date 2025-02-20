<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id','regular_price','sale_price','sku','stock_status','total_sold','image','gallery','status','is_downloadable','downloadable_file','sales','tax_percentage'];
    public function category(){
        return $this->hasOne('App\ProductCategory','id','category_id');
    }
    public function ratings(){
        return $this->hasMany('App\ProductRatings','product_id','id');
    }
    public function lang(){
        return $this->hasOne(ProductsLang::class,'product_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(ProductsLang::class,'product_id')->where(['lang' => front_default_lang()]);
    }
    public function lang_all(){
        return $this->hasMany(ProductsLang::class,'product_id');
    }
    public function category_front(){
        return $this->belongsTo('App\ProductCategoryLang','category_id','category_id')->where('lang',front_default_lang());
    }
}
