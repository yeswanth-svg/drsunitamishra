<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentReview extends Model
{
    protected $table = 'appointment_reviews';
    protected $fillable = ['user_id','ratings','appointment_id','message'];

    public function appointment(){
        return $this->hasOne(AppointmentLang::class,'appointment_id','appointment_id')->where(['lang' => get_default_language()])->select('appointment_id','title');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
