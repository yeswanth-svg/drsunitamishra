<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';
    protected $fillable = ['status','icon'];
    public function lang(){
        return $this->hasOne(ServiceCategoryLang::class,'category_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(ServiceCategoryLang::class,'category_id')->where(['lang' => front_default_lang()]);
     }
    public function lang_all(){
        return $this->hasMany(ServiceCategoryLang::class,'category_id');
    }
}
