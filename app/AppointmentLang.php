<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentLang extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_id','lang','location','title','designation','short_description','description','additional_info','experience_info','specialized_info','meta_description','meta_title','meta_tags','og_meta_description','og_meta_title','og_meta_image','slug'];
   
    public function setAdditionalInfoAttribute($value){
        $final_value = $value ?? [];
       $this->attributes['additional_info'] = serialize($final_value);
    }
    public function setExperienceInfoAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['experience_info'] = serialize($final_value);
    }
    public function setSpecializedInfoAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['specialized_info'] = serialize($final_value);
    }
    public function getAdditionalInfoAttribute($value){
        return unserialize($value,['class' => false]);
    }
    public function getExperienceInfoAttribute($value){
        return unserialize($value,['class' => false]);
    }
    public function getSpecializedInfoAttribute($value){
        return unserialize($value,['class' => false]);
    }
}