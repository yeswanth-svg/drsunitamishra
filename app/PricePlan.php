<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    protected $table = 'price_plans';
    protected $fillable = ['price','btn_url','image'];
    public function lang(){
        return $this->hasOne(PricePlanLang::class,'price_plan_id')->where(['lang' => get_default_language()]);
     }
    public function lang_front(){
        return $this->hasOne(PricePlanLang::class,'price_plan_id')->where(['lang' => front_default_lang()]);
     }
    public function lang_all(){
        return $this->hasMany(PricePlanLang::class,'price_plan_id');
    }
}
