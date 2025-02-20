<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = ['categories_id','icon','icon_type','sr_order','img_icon','image','status','price_plan'];

    public function category(){
        return $this->belongsTo('App\ServiceCategory','categories_id');
    }
    public function lang(){
        return $this->hasOne(ServicesLang::class,'service_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(ServicesLang::class,'service_id')->where(['lang' => front_default_lang()]);
     }
    public function lang_all(){
        return $this->hasMany(ServicesLang::class,'service_id');
    }
    public function category_front(){
        return $this->belongsTo('App\ServiceCategoryLang','categories_id','category_id')->where('lang',front_default_lang());
    }
}
