<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentCategory extends Model
{
    use HasFactory;
    protected $fillable = ['status'];
    
    public function category_all(){
        return $this->hasOne('App\AppointmentCategoryLang','category_id');
    }
    public function category_front(){
        return $this->hasOne('App\AppointmentCategoryLang','category_id')->where('lang',front_default_lang());
    }
    public function lang(){
        return $this->hasOne(AppointmentCategoryLang::class,'category_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(AppointmentCategoryLang::class,'category_id')->where(['lang' => front_default_lang()]);
    }
 
     public function lang_all(){
         return $this->hasMany(AppointmentCategoryLang::class,'category_id');//->groupBy('lang');
     }
}
